<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if ($user->type !== 'admin') {
            return response()->json(['message' => 'Not authorized for API'], 403);
        }

        $token = Str::random(64);

        $apiToken = $user->tokens()->create([
            'token' => hash('sha256', $token),
            'expires_at' => Carbon::now()->addMinutes(15),
        ]);

        return response()->json([
            'token' => $token,
            'expires_at' => $apiToken->expires_at,
        ]);
    }
}
