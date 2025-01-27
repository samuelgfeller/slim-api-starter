<?php

namespace App\Module\User\List\Service;

use App\Module\User\Data\UserData;
use App\Module\User\List\Repository\UserFindListRepository;

final readonly class UserListFinder
{
    public function __construct(
        private UserFindListRepository $userFinderRepository,
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
