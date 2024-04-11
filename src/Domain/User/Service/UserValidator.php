<?php

namespace App\Domain\User\Service;

use App\Domain\Exception\ValidationException;
use Cake\Validation\Validator;

/**
 * User validation.
 * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Validation.
 */
final readonly class UserValidator
{
    /**
     * Validate user values.
     *
     * @param array<string, mixed> $userValues
     * @param bool $isCreateMode
     */
    public function validateUserValues(array $userValues, bool $isCreateMode = true): void
    {
        $validator = new Validator();

        // Cake validation library automatically sets a rule that field cannot be null as soon as there is any
        // validation rule set for the field. This is why we have to allowEmptyString because it also allows null.

        $validator
            ->requirePresence('first_name', $isCreateMode, 'Field is required')
            // Disallow empty strings as field is required
            ->notEmptyString('first_name', 'Required')
            ->minLength('first_name', 2, 'Minimum length is 2')
            ->maxLength('first_name', 100, 'Maximum length is 100')
            ->requirePresence('last_name', $isCreateMode, 'Field is required')
            // Allow null and empty strings as field is not required
            ->allowEmptyString('last_name')
            ->minLength('last_name', 2, 'Minimum length is 2')
            ->maxLength('last_name', 100, 'Maximum length is 100')
            ->requirePresence('email', $isCreateMode, 'Field is required')
            // email() automatically disallows empty strings so the field is required
            ->email('email', false, 'Invalid email')
        ;

        // Validate and throw exception if there are errors
        $errors = $validator->validate($userValues);
        if ($errors) {
            throw new ValidationException($errors);
        }
    }
}
