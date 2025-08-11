<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\CommonHelper;

class BlogCategoryController extends Controller
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
        $blogCategorys = BlogCategory::all();
        return view('panel.admin.blog_category.index', compact('blogCategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.admin.blog_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = CommonHelper::makeUrlSlug($request->slug, 'BlogCategory');
        $request->merge(["slug"=>$slug]);
        $category = BlogCategory::create(request()->validate([
            'title' => 'required|unique:blog_category,title',
            'slug' => 'required|unique:blog_category,slug',
        ]));
        return redirect('/admin/blog_category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('panel.admin.blog_category.edit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        request()->validate([
            'title' => 'required|unique:blog_category,title,' . $blogCategory->id,
            'slug' => 'required|unique:blog_category,slug,' . $blogCategory->slug
        ]);

        $blogCategory->title = $request->title;
        $blogCategory->slug = CommonHelper::makeUrlSlug($request->slug, 'BlogCategory',$blogCategory->id);
        $blogCategory->save();
        $blogCategory->touch();
        return redirect('/admin/blog_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */


    // public function destroy(BlogCategory $blogCategory)
    // {
    //     BlogCategory::destroy($blogCategory->id);
    //     return back();
    // }

    public function destroy(Request $request)
    {

        $ErrorMsg = "";
        $data = [];
        // return $request->all();
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'blog_category_id' => ['required', 'numeric'],
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

                $eloquent = BlogCategory::where("id", $request->blog_category_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Blog Category deleted successfully.";
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting Blog Category. Exception Msg : " . $e->getMessage();
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
