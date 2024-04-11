<?php

namespace App\Application\Action\User;

use App\Domain\User\Service\UserCreator;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class UserCreateAction
{
    public function __construct(
        private UserCreator $userCreator,
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $userValues = (array)$request->getParsedBody();

        $this->userCreator->createUser($userValues);

        return $response->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
