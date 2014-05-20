<?php
define('REQUEST_MICROTIME', microtime(true));

/**
 * Display all errors when APPLICATION_ENV is development.
 */
if ($_SERVER['APPLICATION_ENV'] == 'development') {
	error_reporting(E_ALL & ~E_STRICT);
	ini_set("display_errors", 1);
}

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && 
	is_file(__DIR__. parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

if (!file_exists('vendor/autoload.php')) {
	throw new RuntimeException(
			'Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.'
	);
}

// Setup autoloading
include 'vendor/autoload.php';


// Setup init_autoloading
require 'init_autoloader.php';


if (!defined('APPLICATION_PATH')) {
	define('APPLICATION_PATH', realpath(__DIR__ . '/../'));
}

$appConfig = include APPLICATION_PATH . '/config/application.config.php';


if (file_exists(APPLICATION_PATH . '/config/development.config.php')) {
	$appConfig = Zend\Stdlib\ArrayUtils::merge($appConfig, include APPLICATION_PATH . '/config/development.config.php');
}

// Run the application!
Zend\Mvc\Application::init($appConfig)->run();