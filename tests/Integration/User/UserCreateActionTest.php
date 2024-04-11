<?php

namespace App\Test\Integration\User;

use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\Attributes\DataProviderExternal;
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

    /**
     * Test that no user is created and validation exception is thrown
     * when the user submits invalid data.
     *
     * @param array<string, string> $requestBody data containing invalid user create request data
     * @param array<string, string|array<string|int, mixed>> $expectedJsonResponse expected json response
     */
    #[DataProviderExternal(\App\Test\Provider\User\UserCreateProvider::class, 'invalidUserCreateCases')]
    public function testUserCreateActionInvalid(array $requestBody, array $expectedJsonResponse): void
    {
        // Make request
        $request = $this->createJsonRequest('POST', $this->urlFor('user-create'), $requestBody);
        $response = $this->app->handle($request);

        // Assert status code
        self::assertSame(StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY, $response->getStatusCode());

        // Assert that no database record was created
        $this->assertTableRowCount(0, 'user');

        // Assert that the response contains the validation error messages
        $this->assertJsonData($expectedJsonResponse, $response);
    }
}
