<?php

namespace App\Application\Action\User;

use App\Application\Responder\JsonEncoder;
use App\Domain\User\Service\UserFinder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class UserFetchListAction
{
    public function __construct(
        private JsonEncoder $jsonEncoder,
        private UserFinder $userFinder,
    ) {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $users = $this->userFinder->findAllUsers();

        return $this->jsonEncoder->encodeAndAddToResponse($response, $users);
    }
}
