<?php

namespace App\Http\Middleware;

use App\Enum\ProfileTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdministrator
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() &&  auth()->user()->profile_type == ProfileTypeEnum::Administrator->value) {
            return $next($request);
        }

        return \response()->json([
            'message' => 'Unauthorized'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
