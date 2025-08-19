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
use App\Models\Broker;

/**
 * Class DashboardController
 * Handles the admin dashboard functionality, including data retrieval and logout operations.
 */
class DashboardController extends Controller
{
    /**
     * Constructor to apply middleware for user type management.
     * The 'auth' middleware is currently commented out with exceptions for specific actions.
     */
    public function __construct()
    {
        $this->middleware('manage_user_types');
        // $this->middleware('auth', ['except' => [
        //     'fooAction',
        //     'barAction',
        // ]]);
    }

    /**
     * Display the admin dashboard with relevant statistics based on user type.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::orderBy("name", "ASC");
        $allProjects = Project::orderBy("name", "ASC");

        // Check if the authenticated user is a builder
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            // Retrieve the builder details for the authenticated user
            $builder = Builder::where("user_id", Auth::user()->id)->first();
            $builderProjectIds = ProjectOwners::where("builder_id", $builder->id)->pluck("project_id");

            // Filter projects based on builder's project IDs
            $projects = $projects->whereIn("id", $builderProjectIds);
            $allProjects = $allProjects->whereIn("id", $builderProjectIds);

            // Prepare dashboard data for builder
            $dashboardData["totalProjects"] = $projects->get()->count();
            $dashboardData['admin'] = false;
            $dashboardData["totalBuilders"] = 0;
            $dashboardData["totalBrokers"] = Broker::count(); // Total brokers count
            $dashboardData["totalPendingProjects"] = $projects->where('status', 2)->get()->count();
            $dashboardData["totalActiveProjects"] = $allProjects->where('status', 1)->get()->count();
            $dashboardData["totalWebSiteUser"] = User::where("user_type_id", Config::get("constants.UserTypeIds.WebSiteUser"))->get()->count();
            $dashboardData["totalFavorites"] = Wishlist::where("user_id", Auth::user()->id)->get()->count();
        } else {
            // Prepare dashboard data for admin
            $dashboardData["totalProjects"] = Project::get()->count();
            $dashboardData['admin'] = true;
            $dashboardData["totalPendingProjects"] = Project::where('status', 2)->get()->count();
            $dashboardData["totalActiveProjects"] = Project::where('status', 1)->get()->count();
            $dashboardData["totalBuilders"] = Builder::get()->count();
            $dashboardData["totalBrokers"] = Broker::count(); // Total brokers count
            $dashboardData["totalWebSiteUser"] = User::where("user_type_id", Config::get("constants.UserTypeIds.WebSiteUser"))->get()->count();
            $dashboardData["totalFavorites"] = Wishlist::where("user_id", Auth::user()->id)->get()->count();
        }

        // Return the dashboard view with the prepared data
        return view('panel.admin.dashboard', $dashboardData);
    }

    /**
     * Handle user logout and session invalidation.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
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

    /**
     * Retrieve and display the list of customers (website users).
     *
     * @return \Illuminate\View\View
     */
    public function Customers()
    {
        $users = User::where("user_type_id", Config::get("constants.UserTypeIds.WebSiteUser"))->get();
        return view('customers', compact('users')); // Updated view name to 'customers' for consistency
    }

    /**
     * Retrieve and display the list of favorites for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function Favorites()
    {
        $favorites = Wishlist::where("user_id", Auth::user()->id)->get();
        return view('favorites', compact('favorites'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has logged out of the application.
     *
     * @param Request $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        // Override this method if additional logout logic is needed
    }
}