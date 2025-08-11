<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\ProjectType;
use App\Models\RecentViews;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CommonHelper;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }
    public function show($category, $blog)
    {   
        $category = BlogCategory::where("slug",$category)->first();
        if($category)
        {
            $blog = Blog::where("slug",$blog)->first();
            if($blog)
            {
                $recent_view_data = RecentViews::with('project')
                ->whereDate('created_at', Carbon::today())
                ->where('user_id', Auth::id())->get();
                $tags = Tag::all();  
                $project_types = ProjectType::all();
                return view('blog.show', compact('blog', 'recent_view_data', 'tags', 'project_types'));
            }
        }
        return abort(404, 'Page not found.');
    }
}
