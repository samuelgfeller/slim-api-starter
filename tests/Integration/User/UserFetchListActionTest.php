<?php

namespace App\Test\Integration\User;

use App\Test\Fixture\UserFixture;
use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\FixtureTestTrait;
use TestTraits\Trait\HttpJsonTestTrait;
use TestTraits\Trait\RouteTestTrait;

class UserFetchListActionTest extends TestCase
{
    use AppTestTrait;
    use HttpJsonTestTrait;
    use RouteTestTrait;
    use FixtureTestTrait;

    public function testUserFetchListAction(): void
    {
        // Set test data
        $testUserRow = [
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@doe.com',
        ];

        // Insert test data
        $this->insertFixture(new UserFixture(), $testUserRow);

        // Make request
        $request = $this->createJsonRequest('GET', $this->urlFor('user-list'));
        $response = $this->app->handle($request);

        // Assert status code
        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());

        $jsonData = $this->getJsonData($response);

        // Assert that response data contains the user row inserted into the database above
        self::assertArrayIsEqualToArrayOnlyConsideringListOfKeys($testUserRow, $jsonData[0], array_keys($testUserRow));
    }
}
