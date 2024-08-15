<?php

// Slim middlewares are LIFO (last in, first out) so when responding, the order is backwards
// https://samuel-gfeller.ch/docs/Slim-Middleware#order-of-execution
return function (Slim\App $app) {
    $app->addBodyParsingMiddleware();

    // Add new middlewares here

    $app->addRoutingMiddleware();

    // Has to be after Routing
    $app->add(Selective\BasePath\BasePathMiddleware::class);

    // Error middlewares should be added last as the preprocessing (before handle) will be registered first in a request
    // Returns a response with validation errors
    $app->add(App\Application\Middleware\ValidationExceptionMiddleware::class);
    // Handle and log notices and warnings (throws ErrorException if displayErrorDetails is true)
    $app->add(SlimErrorRenderer\Middleware\NonFatalErrorHandlingMiddleware::class);
    // Add exception handling middleware
    $app->add(SlimErrorRenderer\Middleware\ExceptionHandlingMiddleware::class);

    // Cross-Origin Resource Sharing (CORS) middleware - last middleware to be executed first
    // so that cors header is set before the exception handling middleware catches a possible exception.
    $app->add(App\Application\Middleware\CorsMiddleware::class);
};
