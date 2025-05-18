<?php

namespace App\Core\Middleware;

class CORSMiddleware
{
    public static function handle(): ?string
    {
        // Load the CORS configuration
        $config = require '../config/cors.php';

        $allowedOrigins = $config['allowed_origins'];
        $allowedMethods = implode(', ', $config['allowed_methods']);
        $allowedHeaders = implode(', ', $config['allowed_headers']);
        $allowCredentials = $config['allow_credentials'] ? 'true' : 'false';

        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        // Handle preflight (OPTIONS) requests
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            if (in_array($origin, $allowedOrigins)) {
                self::setCorsHeaders($origin, $allowCredentials, $allowedMethods, $allowedHeaders);
                http_response_code(204); // No Content
            } else {
                http_response_code(403); // Forbidden
            }
            exit;
        }

        // Handle actual requests
        if (in_array($origin, $allowedOrigins)) {
            self::setCorsHeaders($origin, $allowCredentials, $allowedMethods, $allowedHeaders);
            return $origin;
        } else {
            http_response_code(403); // Forbidden
            echo json_encode([
                'error' => 'Direct Access or Origin Not Allowed',
                'received_origin' => $origin
            ]);
            exit;
        }
    }

    /**
     * Set CORS headers for the response.
     */
    private static function setCorsHeaders(string $origin, string $allowCredentials, string $allowedMethods, string $allowedHeaders): void
    {
        header("Access-Control-Allow-Origin: $origin");
        header("Access-Control-Allow-Credentials: $allowCredentials");
        header("Access-Control-Allow-Methods: $allowedMethods");
        header("Access-Control-Allow-Headers: $allowedHeaders");
    }
}