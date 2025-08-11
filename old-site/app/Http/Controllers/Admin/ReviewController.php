<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }

    public function index(Project $project)
    {
        
        $reviews = Review::all();
        return view('panel.admin.reviews.index', compact('reviews'));
    }
}
