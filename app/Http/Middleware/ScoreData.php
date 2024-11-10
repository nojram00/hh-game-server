<?php

namespace App\Http\Middleware;

use App\Http\Requests\Student\ScoreData as StudentScoreData;
use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScoreData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(StudentScoreData $request, Closure $next): Response
    {
        if($request->pre_test == null)
        {

        }
        return $next($request);
    }
}
