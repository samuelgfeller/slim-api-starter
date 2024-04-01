<?php

namespace App\Domain\User\Repository;

use App\Infrastructure\Factory\QueryFactory;

final readonly class UserCreatorRepository
{
    public function __construct(
        private QueryFactory $queryFactory,
    ) {
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
        return (int)$this->queryFactory->insertQueryWithData($userValues)->into('user')->execute()->lastInsertId();
    }
}
