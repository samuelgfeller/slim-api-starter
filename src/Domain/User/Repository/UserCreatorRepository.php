<?php

namespace App\Domain\User\Repository;

use Cake\Database\Connection;

final readonly class UserCreatorRepository
{
    public function __construct(private Connection $connection)
    {
    }

    /**
     * Insert user values into the database.
     *
     * @param array<string, int|string|null> $userRow
     *
     * @return int lastInsertId
     */
    public function insertUser(array $userRow): int
    {
        // Insert user into database
        return (int)$this->connection->insertQuery()
            ->insert(array_keys($userRow))
            ->values($userRow)
            ->into('user')
            ->execute()->lastInsertId();
    }
}
