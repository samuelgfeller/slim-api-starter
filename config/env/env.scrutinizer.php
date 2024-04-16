<?php
/**
 * Environment settings for Scrutinizer CI.
 * These values are relevant for the .scrutinizer.yml file.
 *
 * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/How-to-set-up-Scrutinizer
 */

// Must be "require" and not require_once
require __DIR__ . '/env.test.php';

// Database
$settings['db']['host'] = '127.0.0.1';
$settings['db']['database'] = 'slim_api_starter_test';
$settings['db']['username'] = 'root';
$settings['db']['password'] = '';
