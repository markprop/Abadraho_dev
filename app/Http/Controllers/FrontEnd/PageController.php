<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function aboutUs() {
        return view('pages.about-us');
    }

    public function termsAndConditions() {
        return view('pages.terms-and-conditions');
    }

    public function userProfile() {
        return view('user-profile');
    }
}
