<?php

//This is what turns the back-end into an API. Filters HTTP requests.

namespace App\Core\Middleware;

class CORSMiddleware
{
    public static function handle(): void
    {
        $allowedOrigins = [
            "http://new-arcadia-front.test"
        ];

        $origin = $_SERVER["HTTP_ORIGIN"] ?? "";

        if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
        {
            if(in_array($origin,$allowedOrigins))
            {
                header("Access-Control-Allow-Origin: $origin");
                header("Access-Control-Allow-Credentials: true");
                header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
                header("Access-Control-Allow-Headers: Content-Type, X-CSRF-Token");
                http_response_code(204); //no res
            }
            else
            {
                http_response_code(403); //forbidden
            }
            exit;
        }

        if(in_array($origin,$allowedOrigins))
        {
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Credentials: true");

        }
        else
        {
            http_response_code(403);
            echo json_encode([
                'error' => 'Direct Access or Origin Not Allowed',
                'received origin' => $origin
            ]);
            exit;
        }
    }
}