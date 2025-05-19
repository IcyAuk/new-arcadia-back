<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
require '../config/databaseConfig.php';

use Dotenv\Dotenv;

use App\Core\Middleware\CORSMiddleware;
use App\Core\Bootstrap\Session;
use App\Core\Router;
use App\Controllers\TestController;

// Load .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$origin = CORSMiddleware::handle();
Session::start();

$router = new Router();

$router->add('GET', '/test', function(){
    $test = new TestController();
    $test->index();
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);