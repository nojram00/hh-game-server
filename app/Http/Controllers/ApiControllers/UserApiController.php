<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserApiController extends Controller
{
    public function generate_token(LoginRequest $request)
    {
        $token = $request->generate_token();

        return response()->json([
            'message' => 'Auth success!',
            'token' => $token
        ]);
    }

    public function get_student_info(Request $request)
    {
        try
        {
            return response()->json([
                'data' => $request->user()->student->with('section')
            ]);
        }
        catch (HttpException $e)
        {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }

    }
}
