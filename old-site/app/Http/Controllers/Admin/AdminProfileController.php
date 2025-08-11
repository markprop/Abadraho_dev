<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('panel.admin.admin-profile');
    }

    public function adminprofileupdate(Request $request)

    {

        $user_id = Auth::user()->id;
        $user = User::findOrfail($user_id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->address = $request->input('Address');
        $user->about_me = $request->input('about_me');
        $user->city = $request->input('city');
        $user->phone_number = $request->input('phone_number');
        

        if ($request->hasfile('image')) {
            
            $destination = 'upload/profile/' . $user->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
           

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile/', $filename);
            $user->image = $filename;
        }


        $user->update();
        return redirect()->back()->with('success', 'Your Profile Has Been Updated');
    }
}
