<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Broker;
use App\Models\Area;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Hash;

class AgentManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('manage_user_types');
    }

    /**
     * Display a listing of the agents.
     * Supports optional search by name and email similar to UserManagementController.
     */
    public function index(Request $request)
    {
        $agents = Broker::orderBy('created_at', 'DESC');

        $searchQuery = [];
        $searchQuery['name'] = $request->get('userName') ? $request->get('userName') : null;
        $searchQuery['email'] = $request->get('userEmail') ? $request->get('userEmail') : null;

        $searchQuery['email'] && $agents = $agents->where('contact_email', $searchQuery['email']);
        $searchQuery['name'] && $agents = $agents->where('contact_person_name', 'LIKE', '%'.$searchQuery['name'].'%');

        $agents = $agents->get();

        return view('panel.admin.agents.index', ['admins' => $agents, 'searchQuery' => $searchQuery]);
    }

    public function create()
    {
        $areas = Area::orderBy('name')->get();
        return view('panel.admin.agents.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'contact_person_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:50',
            'contact_email' => 'required|email|max:255',
            'login_password' => 'required|string|min:8',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'agent_since_years' => 'nullable|integer|min:1950|max:2025',
            'deals_in' => 'nullable|array',
            'deals_in.*' => 'string',
            'expertise_areas' => 'nullable|array',
            'expertise_areas.*' => 'integer|exists:areas,id',
        ]);

        $nameParts = preg_split('/\s+/', trim($data['contact_person_name']), 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        $payload = [
            'contact_person_name' => $data['contact_person_name'],
            'contact_number' => $data['contact_number'],
            'contact_email' => $data['contact_email'],
            'company_name' => $data['company_name'] ?? null,
            'company_address' => $data['company_address'] ?? null,
            'agent_since_years' => $data['agent_since_years'] ?? 0,
            'deals_in' => $data['deals_in'] ?? [],
        ];
        if (Schema::hasColumn('brokers', 'first_name')) {
            $payload['first_name'] = $firstName;
        }
        if (Schema::hasColumn('brokers', 'last_name')) {
            $payload['last_name'] = $lastName;
        }
        if (Schema::hasColumn('brokers', 'name')) {
            $payload['name'] = $data['contact_person_name'];
        }
        if (Schema::hasColumn('brokers', 'username')) {
            $emailLocal = explode('@', $data['contact_email'])[0] ?? $firstName;
            $payload['username'] = Str::slug($emailLocal, '_');
        }
        if (Schema::hasColumn('brokers', 'email')) {
            $payload['email'] = $data['contact_email'];
        }
        if (Schema::hasColumn('brokers', 'phone_number')) {
            $payload['phone_number'] = $data['contact_number'];
        }
        if (Schema::hasColumn('brokers', 'password')) {
            $payload['password'] = bcrypt(Str::random(24));
        }
        if (Schema::hasColumn('brokers', 'record_id')) {
            $payload['record_id'] = uniqid('BRK_');
        }
        if (Schema::hasColumn('brokers', 'is_active')) {
            $payload['is_active'] = 1;
        }
        if (Schema::hasColumn('brokers', 'is_archive')) {
            $payload['is_archive'] = 0;
        }
        if (Schema::hasColumn('brokers', 'user_type_id')) {
            $payload['user_type_id'] = Config::get('constants.UserTypeIds.Agent');
        }

        // Create linked user account for broker login
        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => Str::slug($firstName.' '.$lastName, '_'),
            'user_type_id' => Config::get('constants.UserTypeIds.Agent'),
            'email' => $data['contact_email'],
            'password' => Hash::make($data['login_password']),
            'phone_number' => $data['contact_number'],
            'is_archive' => 0,
        ]);

        $payload['user_id'] = $user->id;
        $payload['password'] = Hash::make($data['login_password']);
        $payload['plain_password'] = $data['login_password'];

        $broker = Broker::create($payload);

        $broker->areas()->sync($data['expertise_areas'] ?? []);

        return redirect('/admin/agents')->with('status', 'Agent created successfully');
    }

    public function edit(Broker $broker)
    {
        $areas = Area::orderBy('name')->get();
        $selectedAreaIds = $broker->areas()->pluck('areas.id')->toArray();
        return view('panel.admin.agents.edit', compact('broker', 'areas', 'selectedAreaIds'));
    }

    public function update(Request $request, Broker $broker)
    {
        $data = $request->validate([
            'contact_person_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:50',
            'contact_email' => 'required|email|max:255',
            'login_password' => 'nullable|string|min:8',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'agent_since_years' => 'nullable|integer|min:1950|max:2025',
            'deals_in' => 'nullable|array',
            'deals_in.*' => 'string',
            'expertise_areas' => 'nullable|array',
            'expertise_areas.*' => 'integer|exists:areas,id',
        ]);

        $nameParts = preg_split('/\s+/', trim($data['contact_person_name']), 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        $payload = [
            'contact_person_name' => $data['contact_person_name'],
            'contact_number' => $data['contact_number'],
            'contact_email' => $data['contact_email'],
            'company_name' => $data['company_name'] ?? null,
            'company_address' => $data['company_address'] ?? null,
            'agent_since_years' => $data['agent_since_years'] ?? 0,
            'deals_in' => $data['deals_in'] ?? [],
        ];
        if (Schema::hasColumn('brokers', 'first_name')) {
            $payload['first_name'] = $firstName;
        }
        if (Schema::hasColumn('brokers', 'last_name')) {
            $payload['last_name'] = $lastName;
        }
        if (Schema::hasColumn('brokers', 'name')) {
            $payload['name'] = $data['contact_person_name'];
        }
        if (Schema::hasColumn('brokers', 'username')) {
            $emailLocal = explode('@', $data['contact_email'])[0] ?? $firstName;
            $payload['username'] = Str::slug($emailLocal, '_');
        }
        if (Schema::hasColumn('brokers', 'email')) {
            $payload['email'] = $data['contact_email'];
        }
        if (Schema::hasColumn('brokers', 'phone_number')) {
            $payload['phone_number'] = $data['contact_number'];
        }
        if (Schema::hasColumn('brokers', 'is_active')) {
            $payload['is_active'] = $broker->is_active ?? 1;
        }
        if (Schema::hasColumn('brokers', 'is_archive')) {
            $payload['is_archive'] = $broker->is_archive ?? 0;
        }
        if (Schema::hasColumn('brokers', 'user_type_id')) {
            $payload['user_type_id'] = Config::get('constants.UserTypeIds.Agent');
        }

        // Update linked user (create if missing)
        if (!$broker->user_id) {
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => Str::slug($firstName.' '.$lastName, '_'),
                'user_type_id' => Config::get('constants.UserTypeIds.Agent'),
                'email' => $data['contact_email'],
                'password' => Hash::make($data['login_password'] ?? Str::random(12)),
                'phone_number' => $data['contact_number'],
            ]);
            $payload['user_id'] = $user->id;
        } else {
            $user = User::find($broker->user_id);
            if ($user) {
                $user->first_name = $firstName;
                $user->last_name = $lastName;
                $user->username = Str::slug($firstName.' '.$lastName, '_');
                $user->user_type_id = Config::get('constants.UserTypeIds.Agent');
                $user->email = $data['contact_email'];
                $user->phone_number = $data['contact_number'];
                $user->is_archive = 0;
                if (!empty($data['login_password'])) {
                    $user->password = Hash::make($data['login_password']);
                    $payload['password'] = Hash::make($data['login_password']);
                    $payload['plain_password'] = $data['login_password'];
                }
                $user->save();
            }
        }

        $broker->update($payload);

        $broker->areas()->sync($data['expertise_areas'] ?? []);

        return redirect('/admin/agents')->with('status', 'Agent updated successfully');
    }

    public function show(Broker $broker)
    {
        $broker->load('areas');
        return view('panel.admin.agents.show', compact('broker'));
    }

    public function destroy(Request $request)
    {
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'agent_id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }

            if ($ErrorMsg == "") {
                $eloquent = Broker::where("id", $request->agent_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Agent deleted successfully.";
                    $updatedRecord = DB::select("select * from brokers where id = " . (int)$request->agent_id);
                    $data["data"] = (count($updatedRecord) > 0) ? $updatedRecord : [];
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting agent. Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
        }
        if ($ErrorMsg == "") {
            DB::commit();
            return response()->json($data, 200);
        } else {
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
            return response()->json($data, 200);
        }
    }
}


