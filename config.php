<?php
// load composer library's
include 'vendor/autoload.php';

// set env variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// set development or production mode
define('PROJECT_MODE', $_SERVER['PROJECT_MODE']);

if (PROJECT_MODE == 'development') {
    //error_reporting(0);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

// load classes from /classes
include 'includes/classes_loader.php';

// load generic Functions
include 'includes/functions.php';

// set main project directory
define('DIR', dirname(__DIR__) . '/' . $_SERVER['DIR_FOLDER']);

// Timezone setting
define('TIMEZONE', $_SERVER['TIMEZONE']);
date_default_timezone_set(TIMEZONE);


// Get db handle
$db = (new DB())->connect();

// set url
define('URL', $_SERVER['SERVER_PROTOCOL'] . $_SERVER['SITE_URL']);

