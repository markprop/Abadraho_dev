<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUS;
use App\Exports\ContactUsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactUSController extends Controller
{
    public function index(Request $request)
    {

        $searchQuery = [];

        $contactus = ContactUS::orderBy("id", "desc");
        $name = $request['name'];
        if ($request['name']) $contactus = $contactus->where('name', "like" , '%'.$name.'%');
        if ($request['email']) $contactus = $contactus->where('email', $request['email']);
        if ($request['address']) $contactus = $contactus->where('address', $request['address']);
        if ($request['phone']) $contactus = $contactus->where('phone', $request['phone']);
        if ($request['subject']) $contactus = $contactus->where('subject', $request['subject']);
        if ($request['message']) $contactus = $contactus->where('message', $request['message']);
        if ($request['from'] != "" && $request['to'] != "") {
            $contactus = $contactus->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        $searchQuery['name'] = $request['name'] ? $request['name'] : null;
        $searchQuery['email'] = $request['email'] ? $request['email'] : null;
        $searchQuery['address'] = $request['address'] ? $request['address'] : null;
        $searchQuery['phone'] = $request['phone'] ? $request['phone'] : null;
        $searchQuery['subject'] = $request['subject'] ? $request['subject'] : null;
        $searchQuery['message'] = $request['message'] ? $request['message'] : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";

        $contactus = $contactus->get();
        // dd($searchQuery);

        return view('panel.admin.contact.index', compact('contactus', 'searchQuery'));
    }

    public function show(ContactUS $contact)
    {

        return view('panel.admin.contact.show', compact('contact'));
    }

    public function export(Request $request)
    {
        $fileName = 'ContactInquiry-' . date('Y-m-d-H-i-s') . '.xlsx';
        $fields = $request['fields'];
        return Excel::download(new ContactUsExport($fields), $fileName);
    }
}
