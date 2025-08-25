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
     * Show the application dashboard with recent videos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function import_projects()
    {
        return view('panel.admin.project.import-csv');
    }

    public function import_areas()
    {
        return view('csv_imports.import-areas-csv');
    }

    public function import_types()
    {
        return view('import-types-csv');
    }

    public function import_units()
    {
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
        $projects_name = time() . '.' . $request->projects->extension();
        $request->projects->move(public_path('uploads/project_imports'), $projects_name);
        $file = public_path('uploads/project_imports/' . $projects_name);

        $projectsArray = $this->csvToArray($file);
        for ($i = 0; $i < count($projectsArray); $i++) {
            ProjectType::firstOrCreate($projectsArray[$i]);
        }

        dd(ProjectType::all());
    }

    public function importCsv(Request $request)
    {
        $projects_name = time() . '.' . $request->projects->extension();
        $request->projects->move(public_path('uploads/project_imports'), $projects_name);
        $file = public_path('uploads/project_imports/' . $projects_name);

        $projectsArray = $this->csvToArray($file);
        for ($i = 0; $i < count($projectsArray); $i++) {
            Area::firstOrCreate($projectsArray[$i]);
        }

        dd(Area::all());
    }

    public function importCsvProjects(Request $request)
    {
        $projects_name = time() . '.' . $request->projects->extension();
        $request->projects->move(public_path('uploads/project_imports'), $projects_name);
        $file = public_path('uploads/project_imports/' . $projects_name);

        $projectsArray = $this->csvToArray($file);
        for ($i = 0; $i < count($projectsArray); $i++) {
            Project::firstOrCreate($projectsArray[$i]);
        }
        dump($project);
        die();
        dd(Project::all());
    }

    public function importCsvUnits(Request $request)
    {
        $projects_name = time() . '.' . $request->projects->extension();
        $request->projects->move(public_path('uploads/project_imports'), $projects_name);
        $file = public_path('uploads/project_imports/' . $projects_name);

        $projectsArray = $this->csvToArray($file);
        for ($i = 0; $i < count($projectsArray); $i++) {
            Unit::firstOrCreate($projectsArray[$i]);
        }

        dd(Unit::all());
    }
}