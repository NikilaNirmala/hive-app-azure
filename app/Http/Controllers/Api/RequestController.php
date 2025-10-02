<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function showSpecific(Request $request) {
        $sent = $request->user()->requestsSent;
        if ($sent != null) {
            return response()->json(
                [
                    'data' => $sent,
                ], 200
            );
        }
        return response()->json(
                [
                    'message' => 'No requests found',
                ], 200
            );
    }


    public function index()
    {
        return response()->json(
            ['data' => ModelsRequest::all()], 200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'title'   => 'required|string|max:255',
        'message' => 'required|string',
        'contact_email' => 'required|email|string',
    ]);


    // Create request using current user as sender
    $requestModel = ModelsRequest::create([
        'title'     => $validated['title'],
        'message'   => $validated['message'],
        'contact_email' => $validated['contact_email'],
        'sender_id' =>$request->user()->id,
    ]);

    return response()->json([
        'message' => 'Request sent successfully.',
        'data'    => $requestModel
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelsRequest $request)
    {
        return response()->json(
            ['data' => $request]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsRequest $request)
    {
        $request->delete();
        return response()->json(
            ['message' => 'request deletion success',
        ], 200
        );
    }
}
