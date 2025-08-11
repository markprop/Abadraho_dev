<?php

namespace App\Http\Controllers\API;

use App\Models\Unit;
use App\Models\Project;
use App\Models\ZohoForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Mail;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class ZohoFormController extends BaseController
{
    public function store(Request $request)
    {
    //    dd(Auth::check());
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone_number' => 'required|numeric|min:11',
            'unit_id' => 'required',
            'message' => 'required',
        ]);

        $unit = Unit::where('id', $request->unit_id)->first();
        $project = Project::where('id', $unit->project_id)->first();

        $form = Inquiry::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'unit_id' => $unit->id,
            'project_id' => $project->id,
            'message' => $request->message,
        ]);
        // $insertActivityLog = AppHelper::insertActivityLog($request);
        // dd($insertActivityLog);
        $user_data = array(
            'name' => $request->name,
            'email' => $request->email, 
            'address' => $request->address,
            'phone' => $request->phone_number,
            'unit' => $unit->title,
            'project' => $project->name,
            'messages' => $request->message,
        );
        if ($user_data['email']) {
            Mail::send('mail/user_mail', $user_data, function ($message) use ($user_data) {
                $message->to($user_data['email'], $user_data['name'])->subject('Abad Raho Enquiry');
                $message->from('enquiry@abadraho.com', 'Abad Raho');
            });
        }

        $builder_refer = array(
            'email' => $project->owners->first()->contact_person_email ? $project->owners->first()->contact_person_email : null,
            'name' => $project->owners->first()->contact_person_name ? $project->owners->first()->contact_person_name : null,
        );

        if($builder_refer['email'] != null){
            Mail::send('mail/admin_mail', $user_data, function ($message) use ($builder_refer) {
                $message->to($builder_refer['email'], $builder_refer['name'])->subject('Abad Raho Enquiry');
                $message->Cc('enquiry@abadraho.com', 'Abad Raho')->subject('Abad Raho Enquiry');
                $message->from('enquiry@abadraho.com', 'Abad Raho');
            });
        }

        $response = [
            'data' => $form,
            'success' => true,
            'response' => '200',
            'message' => 'Success',
        ];
        return $this->sendResponse($response, 'Successfully.');
    }
}
