<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Project;
use App\Post;
use Illuminate\Http\Request;


class SitemapController extends Controller
{
    public function index(Request $r)
    {
       
        $projects = Project::orderBy('id','desc')->where('status', 1)->get();
        $blogs = Blog::orderBy('id','desc')->where('is_active', 1)->get();

        return response()->view('sitemap', compact('projects', 'blogs'))
          ->header('Content-Type', 'text/xml');

    }
}