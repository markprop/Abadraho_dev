<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Project;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        // Cache the query results for better performance (e.g., 1 hour)
        $projects = cache()->remember('sitemap_projects', 3600, function () {
            return Project::orderBy('id', 'desc')->where('status', 1)->get();
        });

        $blogs = cache()->remember('sitemap_blogs', 3600, function () {
            return Blog::orderBy('id', 'desc')->where('is_active', 1)->get();
        });

        return response()->view('sitemap', compact('projects', 'blogs'))
            ->header('Content-Type', 'text/xml');
    }
}