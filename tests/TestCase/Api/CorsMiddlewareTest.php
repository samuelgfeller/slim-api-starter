<?php

namespace App\Test\TestCase\Api;

use App\Test\Trait\AppTestTrait;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\HttpTestTrait;

class CorsMiddlewareTest extends TestCase
{
    use AppTestTrait;
    use HttpTestTrait;

    public function testCorsMiddleware(): void
    {
        // Make options request
        $request = $this->createRequest('OPTIONS', '');
        $response = $this->app->handle($request);
        $allowedUrl = $this->container->get('settings')['api']['allowed_origin'];
        // Check that the response contains the Access-Control-Allow-Origin header
        self::assertSame($allowedUrl, $response->getHeaderLine('Access-Control-Allow-Origin'));
    }
}
