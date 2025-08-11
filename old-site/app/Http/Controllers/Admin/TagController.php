<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\AppHelper;

class TagController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('panel.admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        Tag::create([
            'name' => $request->name
        ]);
        return redirect('/admin/tag');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('panel.admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        $tag->touch();
        return redirect('/admin/tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Tag $tag)
    // {
    //     Tag::destroy($tag->id);
    //     return back();
    // }

    public function destroy(Request $request)
    {
        
        // return $request->tag_id;
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'tag_id' => ['required','numeric'],
            ]);
            
            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }
            
            // return $request->all();
            // return response()->json($data, 200);

            if ($ErrorMsg == "") {

                $eloquent = Tag::where("id", $request->tag_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Tag deleted successfully.";
                    // dd($request->tag_id);
                    // dd("select * from projects where id = " . $request->tag_id);
                    $updatedRecord = DB::select("select * from tags where id = " . $request->tag_id);
                    // dd($updatedRecord);
                    $data["data"] = (count($updatedRecord) > 0) ? $updatedRecord : [];
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting TAG. Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
        }
        if ($ErrorMsg == "") {
            DB::commit();
            return response()->json($data, 200);
        } else {
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
            // $data["Obj"] = $request->all();
            return response()->json($data, 200);
        }
    }
}
