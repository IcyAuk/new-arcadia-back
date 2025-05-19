<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    /**
     * Add a route to the router.
     */
    public function add(string $method, string $path, callable $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
        ];
    }

    /**
     * Dispatch the request to the appropriate handler.
     */
    public function dispatch(string $method, string $uri): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $uri) {
                call_user_func($route['handler']);
                return;
            }
        }

        // If no route matches, return a 404 response
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}