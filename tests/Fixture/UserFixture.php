<?php

namespace App\Test\Fixture;

/**
 * User values inserted into the database for testing.
 * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Writing-Tests#fixtures.
 */
class UserFixture
{
    // Table name
    public string $table = 'user';

    /** @var array<array<string, int|string|null>> */
    public array $records = [
        [
            'id' => 1,
            'first_name' => 'Example',
            'last_name' => 'User',
            'email' => 'user@example.com',
            'updated_at' => '2024-01-01 00:00:01',
            'created_at' => '2024-01-01 00:00:01',
            'deleted_at' => null,
        ],
    ];
}
