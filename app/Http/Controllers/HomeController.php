<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Unit;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function import_projects()
    {
        // dd('da');
        return view('panel.admin.project.import-csv');
    }

    public function import_areas()
    {
        // dd('da');
        return view('csv_imports.import-areas-csv');
    }

    public function import_types()
    {
        // dd('da');
        return view('import-types-csv');
    }

    public function import_units()
    {
        // dd('da');
        return view('csv_imports.import-units-csv');
    }

    // CSV File To Array
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    // Import CSV and save the record to the database

    public function importCsvTypes(Request $request)
    {

        // Begin For Documents
        $projects_name = time() . '.' . $request->projects->extension();
        $request->projects->move(public_path('uploads/project_imports'), $projects_name);
        // End For Documents
        $file = public_path('uploads/project_imports/' . $projects_name);

        $projectsArray = $this->csvToArray($file);
        // dd($projectsArray);
        for ($i = 0; $i < count($projectsArray); $i++) {
            // Defining Slug
            // $projectsArray[$i]['slug'] = Str::slug($projectsArray[$i]['name']);

            $project = ProjectType::firstOrCreate($projectsArray[$i]);

            // Adding Pivot Owners
            // $project->owners()->attach(Auth::user()->id);
        }

        dd(ProjectType::all());
    }

    public function importCsv(Request $request)
    {

        // Begin For Documents
        $projects_name = time() . '.' . $request->projects->extension();
        $request->projects->move(public_path('uploads/project_imports'), $projects_name);
        // End For Documents
        $file = public_path('uploads/project_imports/' . $projects_name);

        $projectsArray = $this->csvToArray($file);
        // dd($projectsArray);
        for ($i = 0; $i < count($projectsArray); $i++) {
            // Defining Slug
            // $projectsArray[$i]['slug'] = Str::slug($projectsArray[$i]['name']);

            $project = Area::firstOrCreate($projectsArray[$i]);

            // Adding Pivot Owners
            // $project->owners()->attach(Auth::user()->id);
        }

        dd(Area::all());
    }
    public function importCsvProjects(Request $request)
    {

        // Begin For Documents
        $projects_name = time() . '.' . $request->projects->extension();
        $request->projects->move(public_path('uploads/project_imports'), $projects_name);
        // End For Documents
        $file = public_path('uploads/project_imports/' . $projects_name);

        $projectsArray = $this->csvToArray($file);
        // dd($projectsArray);
        for ($i = 0; $i < count($projectsArray); $i++) {
            // Defining Slug
            // $projectsArray[$i]['slug'] = Str::slug($projectsArray[$i]['name']);
            // $projectsArray[$i]['project_doc'] = null;
            $project = Project::firstOrCreate($projectsArray[$i]);
            // die();
            // Adding Pivot Owners
            // $project->owners()->attach(Auth::user()->id);
        }
        dump($project);
        die();
        dd(Project::all());
    }

    public function importCsvUnits(Request $request)
    {

        // Begin For Documents
        $projects_name = time() . '.' . $request->projects->extension();
        $request->projects->move(public_path('uploads/project_imports'), $projects_name);
        // End For Documents
        $file = public_path('uploads/project_imports/' . $projects_name);

        $projectsArray = $this->csvToArray($file);
        // dd($projectsArray);
        for ($i = 0; $i < count($projectsArray); $i++) {
            // Defining Slug
            // $projectsArray[$i]['slug'] = Str::slug($projectsArray[$i]['name']);

            $project = Unit::firstOrCreate($projectsArray[$i]);

            // Adding Pivot Owners
            // $project->owners()->attach(Auth::user()->id);
        }

        dd(Unit::all());
    }
}
