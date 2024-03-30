<?php
/**
 * Development specific configuration values.
 */

// Set false to show production error pages
$settings['dev'] = true;

// For the that the error is not caught by custom error handler (below)
ini_set('display_errors', $settings['dev'] ? '1' : '0');

// Display error details in browser and throw ErrorException for notices and warnings
$settings['error']['display_error_details'] = $settings['dev'];

// Database
$settings['db']['database'] = 'slim_api_starter';

$settings['api']['allowed_origin'] = 'http://localhost';
