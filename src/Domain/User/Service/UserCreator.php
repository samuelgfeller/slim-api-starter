<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserCreatorRepository;

final readonly class UserCreator
{
    public function __construct(
        private UserCreatorRepository $userCreatorRepository,
        private UserValidator $userValidator,
    ) {
    }

    /**
     * User creation logic.
     *
     * @param array<string, mixed> $userValues
     *
     * @return int insert id
     */
    public function createUser(array $userValues): int
    {
        // Validate user values
        $this->userValidator->validateUserValues($userValues);

        // Create user data object
        $user = new UserData($userValues);
        // Serialize user data object to array where keys represent database fields
        $userRow = $user->toArrayForDatabase();

        // Insert new user into database
        return $this->userCreatorRepository->insertUser($userRow);
    }
}
