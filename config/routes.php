<?php

use Slim\App;

return function (App $app) {
    // Redirect to demo frontend
    $app->redirect('/', 'frontend/home.html', 301)->setName('home-page');

    // Fetch user list
    $app->get('/users', \App\Application\Action\User\UserFetchListAction::class)->setName('user-list');
    // Create user
    $app->post('/users', \App\Application\Action\User\UserCreateAction::class)->setName('user-create');
};
