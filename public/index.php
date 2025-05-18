<?php

require '../vendor/autoload.php';

use App\Core\Middleware\CORSMiddleware;

CORSMiddleware::handle();

//setting cookies
session_set_cookie_params([
    'secure' => false, //Ensures the session cookie is only sent over HTTPS connections. 
    'httponly' => false, //not visible by JS, protection against XSS
    'samesite' => 'None' //less CSRF protection for API
]);

session_start();
session_regenerate_id(true);

header('Content-Type: application/json');
echo json_encode([
    'message' => 'Request accepted',
    'custom' => 'yes, this json originates from the back end',
    'origin' => $origin,
    'session_id' => session_id()
]);