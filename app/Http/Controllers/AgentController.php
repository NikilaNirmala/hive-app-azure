<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class AgentController extends Controller
{

    public function requests(Request $request) {
        return view('agent.requests', [
            'requests' => ModelsRequest::all(),
            'userId' => $request->user()->id,
        ]);
    }
}
