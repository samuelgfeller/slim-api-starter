<?php

use Slim\App;

return function (App $app) {
    // Slim middlewares are LIFO (last in, first out) so when responding, the order is backwards
    // https://github.com/samuelgfeller/slim-example-project/wiki/Middleware#order-of-execution

    $app->addBodyParsingMiddleware();

    $app->addRoutingMiddleware();

    // Has to be after Routing
    $app->add(Selective\BasePath\BasePathMiddleware::class);

    // Handle and log notices and warnings (throws ErrorException if displayErrorDetails is true)
    $app->add(\App\Application\Middleware\NonFatalErrorHandlerMiddleware::class);
    // Set error handler to custom DefaultErrorHandler (defined in container.php)
    $app->add(Slim\Middleware\ErrorMiddleware::class);

    // Cross-Origin Resource Sharing (CORS) middleware
    $app->add(\App\Application\Middleware\CorsMiddleware::class);
};
