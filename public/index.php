<?php

require '../vendor/autoload.php';

use App\Core\Middleware\CORSMiddleware;
use App\Core\Bootstrap\Session;

$origin = CORSMiddleware::handle();
Session::start();

header('Content-Type: application/json');
echo json_encode([
    'message' => 'Request accepted',
    'custom' => 'this json originates from the backend',
    'origin' => $origin,
    'session_id' => session_id()
]);