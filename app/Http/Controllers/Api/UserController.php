<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->userType) {
            return UserResource::collection(User::all());
        }
        $validated = $request->validate(
            ['userType' => 'in:member,agent,admin']
        );
        return UserResource::collection(User::where('user_type', $validated['userType'])->get());

    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new UserResource($request);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function changeStatus(Request $request, User $user)
    {
        if ($user->user_type === 'admin') {
            return response()->json(['message' => 'Admin users cannot be blocked'], 403);
        }
        $user->status = !$user->status;
        $user->update();
        if ($user->status === true) {
            return response()->json(['message' => 'User successfully unblocked'], 200);
        }
        return response()->json(['message' => 'User successfully blocked'], 200);
    }

    public function getUserAds(Request $request)
{

    $user = $request->user();

    $ads = $user->advertisements;

    return response()->json($ads);
}
}
