<?php

namespace App\Helpers;

use Auth;
use App\Helpers\CommonHelper;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class CommonHelper {

    static function makeUrlSlug($slug="", $type, $id = 0) {

        $slug = str_replace(" ", '-', strtolower($slug));
        if($type == 'category') {
            $checkExistingSlug = BlogCategory::where('slug','=', $slug);
            if($id > 0) {
                $checkExistingSlug = $checkExistingSlug->where('id','!=', $id);
            }
            $checkExistingSlug = $checkExistingSlug->get();
        } else {
            $checkExistingSlug = Blog::where('slug','=', $slug);
            if($id > 0) {
                $checkExistingSlug = $checkExistingSlug->where('id','!=', $id);
            }
            $checkExistingSlug = $checkExistingSlug->get();
        }

        if(count($checkExistingSlug) > 0) {
            $slug = $slug.rand(4);
        }
        
        return $slug;
    }
}