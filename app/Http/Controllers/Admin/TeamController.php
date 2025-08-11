<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\User;
use App\Models\Builder;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // return $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }

    public function index()
    {
        // dd(Auth::user()->name, Auth::user()->id);
        $builderId = Auth::user()->id;
        $teams = Team::with('members', 'projects')->where('team_lead_id', $builderId)->get();
        //    dd($teams);
        return view('panel.admin.teams.my-team-index', compact('teams'));
        dd($teams->projects);
    }

    public function myTeams()
    {
        // dd(Auth::user()->name, Auth::user()->id);
        $builderId = Auth::user()->id;
        $teams = Team::where('team_lead_id', $builderId)->get();
        // dd($teams);
        return view('panel.admin.teams.my-team-index', compact('teams'));
        dd($teams->projects);
    }
    public function joinedTeams(Team $team)
    {
        // dd(Auth::user()->id);
        $joinedTeams = $team->builders(Auth::user()->id)->get();
        dd($joinedTeams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $builderId = Auth::user()->id;
        $users = User::all();
        // dd(Auth::user()->id, Project::with('owners')->find(1));
        // dd(Auth::user()->id, Builder::with('projects')->find($builderId));
        $builderDetails = Builder::with('projects')->find($builderId);
        // dd($builderDetails);
        $builderProjects = $builderDetails->projects;
        // dd($users);
        return view('panel.admin.teams.create', compact('users', 'builderDetails', 'builderProjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $builderId = Auth::user()->id;

        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'members' => 'required',
            'projects' => 'required',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'team_lead_id' => $builderId,
            'slug' => Str::slug($request->name),
        ]);

        // Begin for multiple members
        if ($request->members) {
            $team->members()->attach($request->members);
        }
        // End for multiple members

        // Begin for multiple projects
        if ($request->projects) {
            $team->projects()->attach($request->projects);
        }
        // End for multiple projects

        return $team;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function myTeamShow(Team $team)
    {
        // dd(Auth::user()->name, Auth::user()->id);
        $builderId = Auth::user()->id;
        // $team = Team::firstWhere('team_lead_id', 1);
        // dd($team);
        // dd($team);
        return view('panel.admin.teams.my-team-show', compact('team'));
        dd($team->projects);
    }
    public function show(Team $team)
    {
        $teamLead = Builder::where('id', $team->team_lead_id)->first();
        // dd($admin->name);
        $builderId = Auth::user()->id;
        $teamDetails = Team::with('members', 'projects')->where('slug', $team->slug)->get();
        // dd($teamDetails);
        // dd($team, 'Team ID: ' . $team->id, 'Team Lead ID: ' . $team->team_lead_id, $team);
        return view('panel.admin.teams.show', compact('team', 'teamLead'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
