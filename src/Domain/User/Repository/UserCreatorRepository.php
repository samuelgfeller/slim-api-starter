<?php

namespace App\Domain\User\Repository;

use Cake\Database\Connection;

final readonly class UserCreatorRepository
{
    public function __construct(private Connection $connection)
    {
    }

    /**
     * Insert user values into database.
     *
     * @param array $userValues
     *
     * @return int
     */
    public function insertUser(array $userValues): int
    {
        // Insert user into database
        return (int)$this->connection->insertQuery()
            ->insert(array_keys($userValues))
            ->values($userValues)
            ->into('user')
            ->execute()->lastInsertId();
    }
}
