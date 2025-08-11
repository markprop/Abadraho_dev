<?php

namespace App\Http\Controllers\API\Builder;

use App\Http\Controllers\Controller;
use App\Models\Builder;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\API\BaseController as BaseController;

class ProjectController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $builder_id = $request->id;
        $projects = Project::with('units', 'owners');
        $projects = $projects->whereHas('owners', function ($query) use ($builder_id) {
            $query->where('builder_id', $builder_id);
        });

        $data = $projects->get();

        if ($data) {
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } else
            return $this->sendResponse($data, 'Data Not Found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'rooms' => 'required',
            'address' => 'required',
            'area' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'project_type_id' => 'required',
            'progress' => 'required',
            // 'project_doc' => 'required|mimes:pdf|max:10000',
            'installment_length' => 'required',
            // 'owners' => 'required',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'address' => $request->address,
            'area' => $request->area,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'project_type_id' => $request->project_type_id,
            'progress' => $request->progress,
            'rooms' => $request->rooms,
            'details' => $request->details,
            'installment_length' => $request->installment_length,
            'slug' => Str::slug($request->name),
        ]);

        // Begin For Documents
        if ($request->project_doc) {
            $project_doc_name = time() . '.' . $request->project_doc->extension();
            $request->project_doc->move(public_path('uploads/project_documents/project_' . $project->id), $project_doc_name);
            $project->project_doc = $project_doc_name;
        }
        // End For Documents

        // Begin For Images
        if ($request->file('project_imgs')) {
            $imageName = array();
            if ($images = $request->file('project_imgs')) {
                foreach ($images as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('uploads/project_images/project_' . $project->id, $name);
                    $imageName[] = $name;
                }
            }
            $project->project_imgs = implode('|', $imageName);
        }

        // Begin For Cover Images
        if ($request->project_cover_img) {
            $project_cover_img_name = 'cover_' . time() . '.' . $request->project_cover_img->extension();
            $request->project_cover_img->move(public_path('uploads/project_images/project_' . $project->id), $project_cover_img_name);
            $project->project_cover_img = $project_cover_img_name;
        }
        // End For Cover Images


        $project->save();
        // End For Images

        // Begin for multiple owners
        if ($request->owners) {
            $project->owners()->attach($request->owners);
        }
        // End for multiple owners


        $response = [
            'data' => $project,
            'success' => true,
            'response'    => '200',
            'message' => 'Success',
        ];
        return $this->sendResponse($response, 'Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project_slug = $project->slug;
        $project_id = $project->id;
        $data = Project::with('units', 'owners')->where('id', $project_id)->first();

        if ($data) {
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } else
            return $this->sendResponse($data, 'No Data Found');
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
        $project = Project::updateOrCreate(request()->validate([
            'name' => 'required',
            'rooms' => 'required',
            'address' => 'required',
            'area' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'project_type_id' => 'required',
            'progress' => 'required',
            'project_doc' => 'required|mimes:pdf|max:10000',
            'installment_length' => 'required',
        ]));

        // Begin For Documents
        if ($request->project_doc) {
            $project_doc_name = time() . '.' . $request->project_doc->extension();
            $request->project_doc->move(public_path('uploads/project_documents/project_' . $project->id), $project_doc_name);
            $project->project_doc = $project_doc_name;
        }
        // End For Documents

        // Begin For Images
        if ($request->file('project_imgs')) {
            $imageName = array();
            if ($images = $request->file('project_imgs')) {
                foreach ($images as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('uploads/project_images/project_' . $project->id, $name);
                    $imageName[] = $name;
                }
            }
            $project->project_imgs = implode('|', $imageName);
        }
        // End For Images

        // Begin For Cover Images
        if ($request->project_cover_img) {
            $project_cover_img_name = 'cover_' . time() . '.' . $request->project_cover_img->extension();
            $request->project_cover_img->move(public_path('uploads/project_images/project_' . $project->id), $project_cover_img_name);
            $project->project_cover_img = $project_cover_img_name;
        }
        // End For Cover Images

        // Update Record and Timestamp
        $project->save();
        $project->touch();

        // Begin for multiple owners
        if ($request->owners) {
            $project->owners()->sync($request->owners);
        }
        // End for multiple owners

        $response = [
            'data' => $project,
            'success' => true,
            'response'    => '200',
            'message' => 'Success',
        ];
        return $this->sendResponse($response, 'Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $data = $project->delete();

        if ($data) {
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } else
            return $this->sendResponse($data, 'No Data Found');
    }

}
