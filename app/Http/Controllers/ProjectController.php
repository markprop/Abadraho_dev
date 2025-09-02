<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Project::all());
        $projects = Project::all();
        return view('projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create(request()->validate([
            'name' => 'required',
            'address' => 'required',
            'area' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'project_type' => 'required',
            'progress' => 'required',
        ]));
        dd($project);
    }

    public function downloadPdf($projectId, $filename)
    {
        try {
            // Find the project
            $project = Project::findOrFail($projectId);
    
            // Get the project documents
            $docs_exploded = explode('|', $project->project_doc ?? '');
    
            // Log the project documents for debugging
            \Log::info('Project documents', [
                'projectId' => $projectId,
                'project_doc' => $project->project_doc,
                'docs_exploded' => $docs_exploded
            ]);
    
            // Find the matching document
            $fullPath = null;
            foreach ($docs_exploded as $doc) {
                $decodedBasename = rawurldecode(basename($doc));
                $decodedFilename = rawurldecode($filename);
                \Log::info('Comparing filenames', [
                    'doc' => $doc,
                    'decodedBasename' => $decodedBasename,
                    'decodedFilename' => $decodedFilename,
                    'match' => $decodedBasename === $decodedFilename
                ]);
                if ($decodedBasename === $decodedFilename) {
                    $fullPath = public_path('uploads/project_documents/' . $doc);
                    break;
                }
            }
    
            // Check if the file exists
            if ($fullPath && file_exists($fullPath)) {
                // Forcefully clear all output buffers
                while (ob_get_level()) {
                    ob_end_clean();
                }
    
                // Disable compression to prevent chunked encoding issues
                ini_set('zlib.output_compression', 'Off');
    
                // Get file size and content
                $fileSize = filesize($fullPath);
                $fileContent = file_get_contents($fullPath);
    
                if ($fileContent === false || $fileSize === 0) {
                    \Log::error('File content inaccessible or empty', [
                        'projectId' => $projectId,
                        'filename' => $filename,
                        'fullPath' => $fullPath,
                        'fileSize' => $fileSize
                    ]);
                    return redirect()->back()->with('error', 'The file is empty or inaccessible.');
                }
    
                // Log file details for debugging
                \Log::info('Serving file', [
                    'projectId' => $projectId,
                    'filename' => $filename,
                    'fullPath' => $fullPath,
                    'fileSize' => $fileSize . ' bytes',
                    'contentLength' => strlen($fileContent),
                    'firstBytes' => bin2hex(substr($fileContent, 0, 10))
                ]);
    
                // Serve the file with explicit headers
                return response($fileContent, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Length' => $fileSize,
                    'Content-Disposition' => 'attachment; filename="' . rawurldecode($filename) . '"',
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ])->setEncodingOptions(JSON_UNESCAPED_SLASHES);
            }
    
            // Log error and redirect with message
            \Log::error('File not found or path mismatch', [
                'projectId' => $projectId,
                'filename' => $filename,
                'fullPath' => $fullPath,
                'docs' => $docs_exploded
            ]);
            return redirect()->back()->with('error', 'The requested file could not be found or path mismatch.');
        } catch (\Exception $e) {
            // Log any exceptions
            \Log::error('Error downloading PDF', [
                'projectId' => $projectId,
                'filename' => $filename,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'An error occurred while downloading the file.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
