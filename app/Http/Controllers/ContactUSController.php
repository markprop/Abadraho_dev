<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\ContactUS;
use Mail;
use App\Rules\Captcha;
class ContactUSController extends Controller
{
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function contactUS()
   {
       return view('contact');
   }
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function contactUSPost(Request $request)
   {
       $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'subject' => 'required',
        'message' => 'required',
        
        ]);
       ContactUS::create($request->all());

       Mail::send('panel.admin.contact.email',
       array(
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'phone' => $request->get('phone'),
           'subject' => $request->get('subject'),
           'user_message' => $request->get('message')
       ), function($message)
   {
       $message->from('info@abadraho.com');
       $message->to('info@abadraho.com', 'Admin')->subject('Contact Form Inquiry');
   }); 


       return back()->with('success', 'Thank you for your inquiry we will get back to you shortly!');
   }
}