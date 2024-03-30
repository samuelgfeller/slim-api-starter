<?php

namespace App\Test\Fixture;

use TestTraits\Interface\FixtureInterface;

/**
 * User values that can be inserted into the database.
 * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Writing-Tests#fixtures.
 */
class UserFixture implements FixtureInterface
{
    // Table name
    public string $table = 'user';

    public array $records = [
        [
            'id' => 1,
            'first_name' => 'Example',
            'last_name' => 'User',
            'email' => 'user@example.com',
            'updated_at' => '2021-01-01 00:00:01',
            'created_at' => '2021-01-01 00:00:01',
            'deleted_at' => null,
        ],
    ];

    public function getTable(): string
    {
        return $this->table;
    }

    public function getRecords(): array
    {
        return $this->records;
    }
}
