<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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

    public function render($request, Throwable $exception)
    {
        // Handle ModelNotFoundException
        if ($exception instanceof ModelNotFoundException) {
            $modelName = class_basename($exception->getModel());

            // Use a regular expression to split words
            $modelName = preg_replace('/(?<=\\w)(?=[A-Z])/', ' ', $modelName);

            // Construct the error message
            $errorMessage = "Data {$modelName} tidak ditemukan";

            return response()->api(null, $errorMessage, "NOT FOUND", Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $exception);
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->api(
            null,
            $exception->getMessage(),
            $exception->errors(),
            $exception->status
        );
    }
}
