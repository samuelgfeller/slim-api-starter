<?php

namespace App\Application\Action\User;

use App\Application\Responder\JsonResponder;
use App\Domain\User\Service\UserFinder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class UserFetchListAction
{
    public function __construct(
        private JsonResponder $jsonResponder,
        private UserFinder $userFinder,
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $users = $this->userFinder->findAllUsers();

        return $this->jsonResponder->encodeAndAddToResponse($response, $users);
    }
}
