<?php
/**
 * Default configuration values.
 *
 * This file should contain all keys, even secret ones to serve as template.
 *
 * This is the first file loaded in settings.php and can safely define arrays
 * without the risk of overwriting something.
 * The only file where the following is permitted: $settings['db'] = ['key' => 'val', 'nextKey' => 'nextVal'];
 *
 * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Configuration.
 */

// Init settings var
$settings = [];

// Project root dir (1 parent)
$settings['root_dir'] = dirname(__DIR__, 1);

// Error handling
// Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Error-Handling
// Enable error reporting for all errors
error_reporting(E_ALL);
$settings['error'] = [
    // MUST be set to false in production.
    // When set to true, it shows error details and throws an ErrorException for notices and warnings.
    'display_error_details' => false,
    'log_errors' => true,
    'log_error_details' => true,
];

// API documentation: https://github.com/samuelgfeller/slim-example-project/wiki/API-Endpoint
$settings['api'] = [
    // Url that is allowed to make api calls to this app
    'allowed_origin' => null,
];

$settings['public'] = [
    'app_name' => 'Slim API Starter',
];

// Secret values are overwritten in env.php
$settings['db'] = [
    'host' => '127.0.0.1',
    'database' => 'slim_api_starter',
    'username' => 'root',
    'password' => '',
    'driver' => Cake\Database\Driver\Mysql::class,
    'encoding' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    // Enable identifier quoting
    'quoteIdentifiers' => true,
    // Disable query logging
    'log' => false,
    // Turn off persistent connections
    'persistent' => false,
    // PDO options
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

// Phinx database migrations settings
// Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Database-Migrations
$settings['phinx'] = [
    'paths' => [
        'migrations' => $settings['root_dir'] . '/resources/migrations',
        'seeds' => $settings['root_dir'] . '/resources/seeds',
    ],
    'schema_file' => $settings['root_dir'] . '/resources/schema/schema.php',
    'default_migration_prefix' => 'db_change_',
    'generate_migration_name' => true,
    'environments' => [
        // Table that keeps track of the migrations
        'default_migration_table' => 'phinx_migration_log',
        'default_environment' => 'local',
        'local' => [
            /* Environment specifics such as db credentials from the secret config are added in env.phinx.php */
        ],
    ],
];

// Logger: https://github.com/samuelgfeller/slim-example-project/wiki/Logging
$settings['logger'] = [
    // Log file location
    'path' => $settings['root_dir'] . '/logs',
    // Default log level
    'level' => Monolog\Level::Debug,
];

return $settings;
