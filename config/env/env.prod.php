<?php
/**
 * Production-specific configuration values.
 *
 * For these settings to be taken into account in production,
 * $_ENV['APP_ENV'] must be set to "prod" in the env.php file of the productive server.
 *
 * How to set values
 * correct: $settings['db]['key'] = 'val'; $settings['db]['nextKey'] = 'nextVal';
 * incorrect $settings['db'] = [ 'key' => 'val', 'nextKey' => 'nextVal',];
 * Every key must be set by its own to not overwrite the entire array.
 */

// Error handler. More controlled than ini
$settings['error']['display_error_details'] = false;

$settings['logger']['level'] = Monolog\Level::Info;

// $settings['db']['database'] = '';

// $settings['api']['allowed_origin'] = 'https://prod-frontend-domain.com';
