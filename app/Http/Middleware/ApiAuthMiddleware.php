<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorization');

        if (!$header || !str_starts_with($header, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $plainToken = substr($header, 7);

        $token = ApiToken::where('token', hash('sha256', $plainToken))->first();

        if (!$token || $token->expires_at->isPast()) {
            return response()->json(['message' => 'Token expired or invalid'], 401);
        }

        $cacheKey = "rate_limit:{$token->user_id}";
        $count = Cache::get($cacheKey, 0);

        if ($count >= 60) {
            return response()->json(['message' => 'Too Many Requests'], 429);
        }

        Cache::put($cacheKey, $count + 1, now()->addMinute());

        // Token sahibi kullanıcıyı request’e ekle
        $request->merge(['auth_user' => $token->user]);

        return $next($request);
    }
}
