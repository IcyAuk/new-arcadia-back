<?php

error_log('Origin header received: ' . ($_SERVER['HTTP_ORIGIN'] ?? 'NONE'));


$allowedOrigins = [
    'http://new-arcadia-front.test'
];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

//option request is just the browser asking the API for permission
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
{
    if(in_array($origin,$allowedOrigins))
    {

        // Send the same headers as in the normal request
        header('Access-Control-Allow-Origin:'. $origin);
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, X-CSRF-Token');
        http_response_code(204); // No content
        exit;
    }
    else
    {
        http_response_code(403); //forbidden origin
        exit;
    }
}

//real request handling
if (in_array($origin, $allowedOrigins))
{
    header("Access-Control-Allow-Origin:" . $origin);
    header("Access-Control-Allow-Credentials: true");
}
else
{
    http_response_code(403);
    exit;
}


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