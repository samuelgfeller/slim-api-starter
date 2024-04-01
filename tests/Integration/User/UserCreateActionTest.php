<?php

namespace App\Test\Integration\User;

use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\DatabaseTestTrait;
use TestTraits\Trait\HttpJsonTestTrait;
use TestTraits\Trait\RouteTestTrait;

class UserCreateActionTest extends TestCase
{
    use AppTestTrait;
    use HttpJsonTestTrait;
    use RouteTestTrait;
    use DatabaseTestTrait;

    public function testUserCreateAction(): void
    {
        // Set test data
        $testUserData = [
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@doe.com',
        ];

        // Make request
        $request = $this->createJsonRequest('POST', $this->urlFor('user-create'), $testUserData);
        $response = $this->app->handle($request);

        // Assert status code
        self::assertSame(StatusCodeInterface::STATUS_CREATED, $response->getStatusCode());

        // Assert that the user was created in the database
        $this->assertTableRow($testUserData, 'user', $testUserData['id']);
    }

    public function testUserCreateActionInvalid(): void
    {
        // Set invalid data
        $invalidUserData = [
            'first_name' => 'J', // min length is 2
            'last_name' => 'D', // min length is 2
            'email' => 'invalid-email',
        ];
        // Make request
        $request = $this->createJsonRequest('POST', $this->urlFor('user-create'), $invalidUserData);
        $response = $this->app->handle($request);

        // Assert status code
        self::assertSame(StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY, $response->getStatusCode());

        // Assert that no database record was created
        $this->assertTableRowCount(0, 'user');

        // Assert that the response contains the validation error messages
        $this->assertJsonData([
            'status' => 'error',
            'message' => 'Validation error',
            'data' => [
                'errors' => [
                    'first_name' => [
                        0 => 'Minimum length is 2',
                    ],
                    'last_name' => [
                        0 => 'Minimum length is 2',
                    ],
                    'email' => [
                        0 => 'Invalid email',
                    ],
                ],
            ],
        ], $response);
    }
}
