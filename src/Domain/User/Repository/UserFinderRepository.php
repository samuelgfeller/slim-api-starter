<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;
use App\Infrastructure\Utility\Hydrator;
use Cake\Database\Connection;

final readonly class UserFinderRepository
{
    public function __construct(
        private Connection $connection,
        private Hydrator $hydrator,
    ) {
    }

    /**
     * Return all users.
     *
     * @return UserData[]
     */
    public function findAllUsers(): array
    {
        $query = $this->connection->selectQuery()->select([
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
