<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;
use App\Infrastructure\Factory\QueryFactory;
use App\Infrastructure\Utility\Hydrator;

final readonly class UserFinderRepository
{
    public function __construct(
        private QueryFactory $queryFactory,
        private Hydrator $hydrator
    ) {
    }

    /**
     * Return all users.
     *
     * @return UserData[]
     */
    public function findAllUsers(): array
    {
        $query = $this->queryFactory->selectQuery()->select([
            'id',
            'first_name',
            'last_name',
            'email',
            'updated_at',
            'created_at',
        ])->from('user')->where(
            ['deleted_at IS' => null]
        );

        $userRows = $query->execute()->fetchAll('assoc') ?: [];

        // Convert to list of objects
        return $this->hydrator->hydrate($userRows, UserData::class);
    }
}
