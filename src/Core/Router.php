<?php
namespace Scandiweb\WebDeveloper\Core;

class Router
{
    private $routes = [];

    public function addRoute($uri, $method, callable $action)
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'action' => $action,
        ];
    }

    public function dispatch($requestUri, $requestMethod)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $requestUri && ($route['method'] === $requestMethod || $requestMethod === 'OPTIONS')) {
                call_user_func($route['action']);
                return;
            }
        }
        $this->handleNotFound($requestUri);
    }

    private function handleNotFound($requestUri)
    {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Route not found', 'route' => $requestUri]);
    }

    private function handleMethodNotAllowed()
    {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    }
}
