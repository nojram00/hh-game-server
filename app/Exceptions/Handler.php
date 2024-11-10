<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);
        $status = $response->getStatusCode();

        Log::info($request->wantsJson());

        if ($request->wantsJson())
        {
            return match($status)
            {
                404 => response()->json([
                    'message' => 'Ops, wrong link! Try mo yung iba...'
                ]),

                401 => response()->json([
                    'message' => 'May mga bagay na di ka pwedeng puntahan at isa na to don...
                        \nSolution: Baka ibang role, try mo maglogin ng ibang user role o baka di ka nakalogin...'
                ]),

                default => $response
            };
        }

        return match ($status){
            // 500 => Inertia::render('Errors/ErrorPage',[
            //     'code' => $status,
            //     'error' => 'Internal Server Error',
            //     'message' => 'Baka may mali kang nalagay boi...'
            // ]),

            404 => Inertia::render('Errors/ErrorPage',[
                'code' => $status,
                'error' => "Not Found",
                'message' => 'Ops, wrong link! Try mo yung iba...'
            ]),

            401 => Inertia::render('Errors/ErrorPage',[
                'code' => $status,
                'error' => 'Unathorized',
                'message' => 'May mga bagay na di ka pwedeng puntahan at isa na to don...
                        <br>Solution: Baka ibang role, try mo maglogin ng ibang user role o baka di ka nakalogin...'
            ]),

            default => $response

        };

        return $response;
    }


}
