<?php

use Slim\App;

return function (App $app) {
    // Redirect to demo frontend
    $app->redirect('/', 'frontend/home.html', 301)->setName('home-page');

    // Fetch user list
    $app->get('/users', \App\Module\User\List\Action\UserFetchListAction::class)->setName('user-list');
    // Create user
    $app->post('/users', \App\Module\User\Create\Action\UserCreateAction::class)->setName('user-create');
};
