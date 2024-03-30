<?php

namespace App\Domain\User\Data;

class UserData implements \JsonSerializable
{
    // Variable names matching database columns (camelCase instead of snake_case)
    public ?int $id;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $email;
    public ?\DateTimeImmutable $updatedAt;
    public ?\DateTimeImmutable $createdAt;

    public function __construct(array $userData = [])
    {
        // Keys may be taken from view form or database, so they have to correspond to both; otherwise use mapper
        $this->id = $userData['id'] ?? null;
        $this->firstName = $userData['first_name'] ?? null;
        $this->lastName = $userData['last_name'] ?? null;
        $this->email = $userData['email'] ?? null;
        try {
            $this->updatedAt = $userData['updated_at'] ?? null ? new \DateTimeImmutable($userData['updated_at']) : null;
        } catch (\Exception $e) {
            $this->updatedAt = null;
        }
        try {
            $this->createdAt = $userData['created_at'] ?? null ? new \DateTimeImmutable($userData['created_at']) : null;
        } catch (\Exception $e) {
            $this->createdAt = null;
        }
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'updatedAt' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'createdAt' => $this->createdAt?->format('Y-m-d H:i:s'),
        ];
    }
}
