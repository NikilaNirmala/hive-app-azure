<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function dashboard() {
        return view('member.dashboard');
    }

    public function sendRequest(Request $request) {
        return view('member.request', ['user_email' => $request->user()->email]);
    }
}
