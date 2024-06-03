<?php

namespace App\Exceptions;

use App\Exceptions\Concerns\ExceptionFormatter;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Inertia\Inertia;
use jeremykenedy\LaravelRoles\App\Exceptions\LevelDeniedException;
use jeremykenedy\LaravelRoles\App\Exceptions\PermissionDeniedException;
use jeremykenedy\LaravelRoles\App\Exceptions\RoleDeniedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ExceptionFormatter;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        RoleDeniedException::class,
        PermissionDeniedException::class,
        LevelDeniedException::class,
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($this->permissionException($e)) {
            abort(403, 'Unauthorized Access.');
        }

        return parent::render($request, $e);
    }

    /**
     * Render a default exception response if any.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderExceptionResponse($request, Throwable $e)
    {
        $response = parent::renderExceptionResponse($request, $e);

        if ($request->wantsJson() && ! $request->header('X-Inertia')) {
            return $response;
        }

        if (! $request->is('api/*')) {
            return $this->inertiaRender($request, $e) ?: $response;
        }

        return $response;
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Throwable|\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface  $e
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function inertiaRender(Request $request, Throwable $e)
    {
        if ($e instanceof HttpException && $e->getStatusCode() === 419) {
            return back()->with([
                'message' => 'The page expired, please try again.',
            ]);
        }

        if (config('app.debug')) {
            return null;
        }

        if (! $e instanceof HttpException) {
            $e = new HttpException(500, $e->getMessage());
        }

        if (in_array($e->getStatusCode(), [500, 503, 404, 403])) {
            return Inertia::render('admin.error', [
                'status' => $e->getStatusCode(),
            ])->toResponse($request)->setStatusCode($e->getStatusCode());
        }
    }

    /**
     * @return bool
     */
    protected function permissionException(Throwable $e)
    {
        return $e instanceof RoleDeniedException ||
            $e instanceof PermissionDeniedException ||
            $e instanceof LevelDeniedException;
    }

    /**
     * List of url path that use custom Exception Format. You can use Regex in the list
     *
     * @return array<string>
     *
     * @example return [
     *  'api/v[1-9]+/.*'
     * ];
     */
    protected function urlPathPattern()
    {
        return [
            'api/admin/v[1-9]+/.*',
        ];
    }
}
