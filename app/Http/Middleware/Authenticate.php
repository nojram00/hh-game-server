<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : $this->redirect_path($request);
    }

    private function redirect_path(Request $request)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'message' => 'You are unauthenticated'
            ], 401);
        }

        return route('login');
    }
}
