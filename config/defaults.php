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
 * Documentation: https://samuel-gfeller.ch/docs/Configuration.
 */

// Init settings var
$settings = [];

// Project root dir (1 parent)
$settings['root_dir'] = dirname(__DIR__, 1);

// Enable error reporting for all errors
error_reporting(E_ALL);
// Error handling. Documentation: https://samuel-gfeller.ch/docs/Error-Handling
$settings['error'] = [
    // MUST be set to false in production to prevent disclosing sensitive information.
    // When set to true, it shows error details and throws an ErrorException for notices and warnings.
    'display_error_details' => false,
    'log_errors' => true,
];

// API documentation: https://samuel-gfeller.ch/docs/API-Endpoint
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
// Documentation: https://samuel-gfeller.ch/docs/Database-Migrations
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

// Logger: https://samuel-gfeller.ch/docs/Logging
$settings['logger'] = [
    // Log file location
    'path' => $settings['root_dir'] . '/logs',
    // Default log level
    'level' => Monolog\Level::Debug,
];

return $settings;
