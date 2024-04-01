<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserCreatorRepository;

final readonly class UserCreator
{
    public function __construct(
        private UserCreatorRepository $userCreatorRepository,
        private UserValidator $userValidator,
    ) {
    }

    /**
     * Create new user with given values.
     *
     * @param array $userValues
     *
     * @return int user id
     */
    public function createUser(array $userValues): int
    {
        $this->userValidator->validateUserValues($userValues);

        return $this->userCreatorRepository->insertUser($userValues);
    }
}
