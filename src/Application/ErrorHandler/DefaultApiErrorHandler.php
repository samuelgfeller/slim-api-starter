<?php

namespace App\Application\ErrorHandler;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpException;
use Slim\Interfaces\ErrorHandlerInterface;
use Throwable;

final readonly class DefaultApiErrorHandler implements ErrorHandlerInterface
{
    public function __construct(private ResponseFactoryInterface $responseFactory, private LoggerInterface $logger)
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @param Throwable $exception
     * @param bool $displayErrorDetails
     * @param bool $logErrors
     * @param bool $logErrorDetails
     *
     * @throws Throwable
     * @throws \ErrorException
     *
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ): ResponseInterface {
        // Log error
        // If exception is an instance of ErrorException it means that the NonFatalErrorHandlerMiddleware
        // threw the exception for a warning or notice.
        // That middleware already logged the message, so it doesn't have to be done here.
        // The reason it is logged there is that if displayErrorDetails is false, ErrorException is not
        // thrown and the warnings and notices still have to be logged in prod.
        if ($logErrors && !$exception instanceof \ErrorException) {
            // Error with no stack trace https://stackoverflow.com/a/2520056/9013718
            $this->logger->error(
                sprintf(
                    'Error: [%s] %s File %s:%s , Method: %s, Path: %s',
                    $exception->getCode(),
                    $exception->getMessage(),
                    $exception->getFile(),
                    $exception->getLine(),
                    $request->getMethod(),
                    $request->getUri()->getPath()
                )
            );
        }

        // Error output if script is called via cli (e.g. testing)
        if (PHP_SAPI === 'cli') {
            // If the column is not found and the request is coming from the command line, it probably means
            // that the database schema.sql was not updated after a change.
            if ($exception instanceof \PDOException && str_contains($exception->getMessage(), 'Column not found')) {
                echo "Column not existing. Try running `composer schema:generate` in the console and run tests again. \n";
            }

            // Restore previous error handler when the exception has been thrown to satisfy PHPUnit v11
            // It is restored in the post-processing of the NonFatalErrorHandlerMiddleware, but the code doesn't
            // reach it when there's an exception (especially needed for tests expecting an exception).
            // Related PR: https://github.com/sebastianbergmann/phpunit/pull/5619
            restore_error_handler();

            // The exception is thrown to have the standard behaviour (important for testing).
            throw $exception;
        }

        // Create response
        $response = $this->responseFactory->createResponse();

        // Detect status code
        $statusCode = $this->getHttpStatusCode($exception);
        $response = $response->withStatus($statusCode);
        // Reason phrase is the text that describes the status code e.g. 404 => Not found
        $reasonPhrase = $response->getReasonPhrase();

        // If it's a HttpException it's safe to show the error message to the user
        $exceptionMessage = $exception instanceof HttpException ? $exception->getMessage() : null;

        // Error details are never returned to the client. The log file is the only place where the details are stored.
        $jsonErrorResponse = [
            'status' => $statusCode,
            'message' => $exceptionMessage ?? $reasonPhrase,
        ];

        // If displayErrorDetails is true, add the error message to the response body
        if ($displayErrorDetails === true) {
            $jsonErrorResponse['error'] = $exception->getMessage();
        }

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(
            json_encode($jsonErrorResponse, JSON_PARTIAL_OUTPUT_ON_ERROR) ?: 'An error occured.'
        );

        return $response;
    }

    /**
     * Determine http status code.
     *
     * @param Throwable $exception The exception
     *
     * @return int The http code
     */
    private function getHttpStatusCode(Throwable $exception): int
    {
        // Default status code
        $statusCode = StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR; // 500

        // HttpExceptions have a status code
        if ($exception instanceof HttpException) {
            $statusCode = (int)$exception->getCode();
        }

        $file = basename($exception->getFile());
        if ($file === 'CallableResolver.php') {
            $statusCode = StatusCodeInterface::STATUS_NOT_FOUND; // 404
        }

        return $statusCode;
    }
}
