<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserCreatorRepository;
use App\Domain\User\Repository\UserFinderRepository;

final readonly class UserCreator
{
    public function __construct(
        private UserCreatorRepository $userCreatorRepository,
        private UserValidator $userValidator,
    ) {
    }

    /**
     * Create new user with given values
     *
     * @return int user id
     */
    public function createUser(array $userValues): int
    {
        $this->userValidator->validateUserValues($userValues);

        return $this->userCreatorRepository->insertUser($userValues);
    }
}
