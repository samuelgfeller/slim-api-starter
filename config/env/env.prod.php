<?php
/**
 * Production-specific configuration values.
 *
 * For these settings to be taken into account in production,
 * $_ENV['APP_ENV'] must be set to "prod" in the secret env.php file of the prod server.
 *
 * Every key must be set by its own to not overwrite the entire array.
 * Correct: $settings['db]['key'] = 'val'; $settings['db]['nextKey'] = 'nextVal';
 * Incorrect; $settings['db'] = [ 'key' => 'val', 'nextKey' => 'nextVal',];
 */

// Error handler. More controlled than ini
$settings['error']['display_error_details'] = false;

$settings['logger']['level'] = Monolog\Level::Info;

// $settings['db']['database'] = '';

// $settings['api']['allowed_origin'] = 'https://prod-frontend-domain.com';
