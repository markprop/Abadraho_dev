<?php

namespace App\Http\Controllers\API\Builder;

use App\Http\Controllers\API\BaseController;
use App\Models\Team;
use App\Models\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TeamController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myTeams(Request $request)
    {
        $builderId = $request->id;
        $data = Team::with('members', 'projects')->where('team_lead_id', $builderId)->get();

        if ($data){
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }
        else
            return $this->sendResponse($data, 'No Data Found');
    }
    public function joinedTeams(Request $request)
    {
        $id = $request->id;
        $teams = Team::with('builders')->whereHas('builders', function ($query) use ($id) {
            $query->where('builder_id', $id);
        });

        $data = $teams->get();

        if ($data){
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }
        else
            return $this->sendResponse($data, 'No Data Found');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createTeam(Request $request)
    {
        $builderId = $request->id;

        $builderDetails = Builder::with('projects')->find($builderId);
        $data = $builderDetails;

        if ($data){
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }
        else
            return $this->sendResponse($data, 'No Data Found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_builder_id = $request->id;
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'members' => 'required',
            'projects' => 'required',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'team_lead_id' => $current_builder_id,
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

        $data = $team;

        if ($data){
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }
        else
            return $this->sendResponse($data, 'No Data Found');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $teamLead = Builder::where('id', $team->team_lead_id)->first();
        $teamDetails = Team::with('members', 'projects')->where('slug', $team->slug)->first();
        $data = [$teamLead, $teamDetails];

        if ($data){
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }
        else
            return $this->sendResponse($data, 'No Data Found');
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
        $current_builder_id = $request->id;
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'members' => 'required',
            'projects' => 'required',
        ]);

        $team->name = $request->name;
        $team->description = $request->description;
        $team->team_lead_id = $current_builder_id;
        $team->slug = Str::slug($request->name);

        $team->save();
        $team->touch();

        // Begin for multiple members
        if ($request->members) {
            $team->members()->sync($request->members);
        }
        // End for multiple members

        // Begin for multiple projects
        if ($request->projects) {
            $team->projects()->sync($request->projects);
        }
        // End for multiple projects

        $data = $team;

        if ($data){
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }
        else
            return $this->sendResponse($data, 'No Data Found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $data = $team->delete();

        if ($data){
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }
        else
            return $this->sendResponse($data, 'No Data Found');
    }
}
