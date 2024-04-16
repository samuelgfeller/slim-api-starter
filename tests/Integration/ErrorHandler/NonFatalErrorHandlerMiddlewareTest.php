<?php

namespace App\Test\Integration\ErrorHandler;

use App\Test\Trait\AppTestTrait;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\HttpTestTrait;

class NonFatalErrorHandlerMiddlewareTest extends TestCase
{
    use AppTestTrait;
    use HttpTestTrait;

    /**
     * Test that when a non-fatal error occurs, the NonFatalErrorHandlerMiddleware
     * makes an ErrorException. This is to make the app "exception-heavy"
     * and display a proper stack trace and error page in development.
     * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Error-Handling.
     *
     * @return void
     */
    public function testNonFatalErrorHandler(): void
    {
        // Add a route that triggers a non-fatal error
        $this->app->get('/error', function ($request, $response, $args) {
            // This will trigger a PHP notice because $undefinedVar is not defined
            /** @phpstan-ignore-next-line */
            echo $undefinedVar['a'];

            return $response;
        });

        $request = $this->createRequest('GET', '/error');

        // Expect that an ErrorException is thrown
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('Undefined variable $undefinedVar');

        // Process the request through the application
        $this->app->handle($request);
    }
}
