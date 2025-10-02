<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiUserLoginRequest;
use App\Models\BlockedUser;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    use ApiResponse;
    public function login(ApiUserLoginRequest $request) {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            Log::warning('Login attempt with incorrect password', [
                            'email' => $request->email,
                            'ip' => $request->ip(),
                            'user-agent'=> $request->userAgent(),
                        ]);
            return $this->error('Invalid User credentials!!', 401);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user->status) {
            Log::warning('Login attempt on blocked User', [
                            'email' => $request->email,
                            'ip' => $request->ip(),
                            'user-agent'=> $request->userAgent(),
                        ]);
            return response()->json([
            'message' => 'This email is blocked and cannot make a request.'
        ], 403);
        }
        $user = User::firstWhere('email', $request->email);

        return $this->ok(
            'Authentication Success',
            ['token' => $user->createToken('api token'.$user->email, ['*'], now()->addMinutes(30))->plainTextToken]
        );
    }

    public function logout(Request $request) {
    if ($request->user()) {
    $token = $request->bearerToken();
    $accessToken = PersonalAccessToken::findToken($token);

    if ($accessToken) {
        $accessToken->delete();
    }
    return response()->json(['message' => 'Logged out successfully']);
}
}

        // Member signup
    public function signupMember(Request $request)
    {
        return $this->signup($request, 'member');
    }


    // Agent signup
    public function signupAgent(Request $request)
    {
        return $this->signup($request, 'agent');
    }

    // Admin signup
    public function signupAdmin(Request $request)
    {
        return $this->signup($request, 'admin');
    }

    // Common signup logic
    protected function signup(Request $request, $type)
    {
        // Validate input
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6|confirmed',
        ]);

        // Force the user_type to match the route
        $user = User::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'full_name'   => $validated['full_name'] ?? null,
            'dob'         => $validated['dob'] ?? null,
            'gender'      => $validated['gender'] ?? null,
            'phone_no'    => $validated['phone_no'] ?? null,
            'description' => $validated['description'] ?? null,
            'user_type'   => $type,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => ucfirst($type) . ' registered successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

}
