<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Builder;
use App\Models\Project;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\ProjectOwners;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('manage_user_types');
        // $this->middleware('auth', ['except' => [
        //     'fooAction',
        //     'barAction',
        // ]]);
    }

    public function index() {
        $projects = Project::orderBy("name", "ASC");
        $allProjects = Project::orderBy("name", "ASC");
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            // dd($BuilderProjectIds->toArray());

            $projects = $projects->whereIn("id", $BuilderProjectIds);
            $allProjects = $allProjects->whereIn("id", $BuilderProjectIds);
            $DashboardData["totalProjects"] = $projects->get()->count();
            $DashboardData['admin'] = false;

            $DashboardData["totalPendingProjects"] = $projects->where('status', 2)->get()->count();
            $DashboardData["totalActiveProjects"] = $allProjects->where('status', 1)->get()->count();
            $DashboardData["totalWebSiteUser"] = User::where("user_type_id", Config::get("constants.UserTypeIds.WebSiteUser"))->get()->count();
            $DashboardData["totalFavorites"] = Wishlist::where("user_id", Auth::user()->id)->get()->count();
            // $DashboardData["totalfavorites"] = Wishlist::where("user_id")->get(); 
            // dd($projects->get()->count());
        } else {
            $DashboardData["totalProjects"] = Project::get()->count();
            $DashboardData['admin'] = true;
            $DashboardData["totalPendingProjects"] = Project::where('status', 2)->get()->count();
            $DashboardData["totalActiveProjects"] = Project::where('status', 1)->get()->count();
            $DashboardData["totalBuilders"] = Builder::get()->count();
            $DashboardData["totalWebSiteUser"] = User::where("user_type_id", Config::get("constants.UserTypeIds.WebSiteUser"))->get()->count();
            $DashboardData["totalFavorites"] = Wishlist::where("user_id", Auth::user()->id)->get()->count();
            // dd($DashboardData["totalWebSiteUser"]);
        }
        return view('panel.admin.dashboard', $DashboardData);
    }

    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    // No of customers-websiteuser
    public function Customers() {
        $user = User::where("user_type_id", -10024)->get();
        return view('Customer', compact('user'));
    }

    public function Favorites() {
        $fav = Wishlist::where("user_id", Auth::user()->id)->get();
        return view('favorites', compact('fav'));
    }
}
