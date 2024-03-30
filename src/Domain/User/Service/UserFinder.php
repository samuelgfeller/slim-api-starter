<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserFinderRepository;

final readonly class UserFinder
{
    public function __construct(
        private UserFinderRepository $userFinderRepository,
    ) {
    }

    /**
     * Returns all users.
     *
     * @return UserData[]
     */
    public function findAllUsers(): array
    {
        return $this->userFinderRepository->findAllUsers();
    }
}
