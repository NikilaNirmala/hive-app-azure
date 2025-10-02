<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function redirect(Request $request) {
        $type = $request->user()->user_type;
        if ($type === 'admin') {
            return redirect()->route('admin.dashboard');
        } else if ($type == 'agent') {
            return redirect()->route('agent.requests');
        } else if  ($type === 'member'){
            return redirect()->route('member.dashboard');
        } else {
            abort(404);
        }
    }
}
