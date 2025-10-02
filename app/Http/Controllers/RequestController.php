<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'contact_email' => 'required|email',
        ]);


        ModelsRequest::create([
            'title' => $request->title,
            'message' => $request->message,
            'contact_email' => $request->contact_email,
            'sender_id' => $request->user()->id,
        ]);
        return redirect()->route('member.request');
    }
}
