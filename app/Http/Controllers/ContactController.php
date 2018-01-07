<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required',
            'message' => 'required',
        ]);

        $msg          = new Contact();
        $msg->name    = $request->get('name');
        $msg->email   = $request->get('email');
        $msg->message = $request->get('message');
        $msg->save();

        return redirect()->route('contact.create')->with('status', 'Message has been successfully sent! (stored to the db btw)');
    }
}
