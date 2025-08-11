<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\AppHelper;

class BlogController extends Controller
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
        $blogs = Blog::all();
        return view('panel.admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogcategories = BlogCategory::all();
        return view('panel.admin.blog.create', compact('blogcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $is_active = (int)$request->is_active;

        $blog = Blog::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_active' => $is_active,
            'slug' => Str::slug($request->title),
        ]);

        // Begin For Cover Image
        if ($request->cover_img) {
            $cover_img_name = 'cover_' . time() . '.' . $request->cover_img->extension();
            $request->cover_img->move(public_path('uploads/blogs'), $cover_img_name);
            $blog->cover_img = $cover_img_name;
        }
        // End For Cover Images
        $blog->save();
        return redirect('/admin/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $blogcategories = BlogCategory::all();
        return view('panel.admin.blog.edit', compact('blogcategories', 'blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->category_id = $request->category_id;
        $blog->is_active = $request->is_active;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;

        // Begin For Blog Cover

        // If New Image Found
        if ($request->cover_img) {
            // Delete Previous Image
            $image_path = '/uploads/blogs/' . $blog->cover_img;
            File::delete(public_path() . $image_path);

            // Save New Image
            $cover_img_name = 'cover_' . time() . '.' . $request->cover_img->extension();
            $request->cover_img->move(public_path('uploads/blogs'), $cover_img_name);
            $blog->cover_img = $cover_img_name;
        }
        // If Image Deleted
        elseif ($request->cover_img_remove == 1) {
            $image_path = '/uploads/blogs/' . $blog->cover_img;
            File::delete(public_path() . $image_path);
            $blog->cover_img = NULL;
        }

        $blog->save();
        $blog->touch();
        return redirect('/admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Blog $blog)
    // {
    //     $blog = Blog::destroy($blog->id);
    //     return back();
    // }

    public function destroy(Request $request)
    {
        
        // return $request->blog_id;
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'blog_id' => ['required','numeric'],
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

                $eloquent = Blog::where("id", $request->blog_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Blog deleted successfully.";
                    // dd($request->blog_id);
                    // dd("select * from projects where id = " . $request->blog_id);
                    $updatedRecord = DB::select("select * from blog where id = " . $request->blog_id);
                    // dd($updatedRecord);
                    $data["data"] = (count($updatedRecord) > 0) ? $updatedRecord : [];
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting blog. Exception Msg : " . $e->getMessage();
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
