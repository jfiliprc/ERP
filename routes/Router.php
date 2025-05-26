<?php

namespace Routes;

class Router
{
    protected string $namespace = "";
    protected array $routes = [];

    public function namespace(string $namespace): void
    {
        $this->namespace = rtrim($namespace, '\\');
    }

    public function add(string $method, string $path, string $handler): void
    {
        $this->routes[strtoupper($method)][$path] = $handler;
    }

    public function get(string $path, string $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, string $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    public function put(string $path, string $handler): void
    {
        $this->add('PUT', $path, $handler);
    }

    public function delete(string $path, string $handler): void
    {
        $this->add('DELETE', $path, $handler);
    }

    public function dispatch(string $requestUri, string $requestMethod): void
    {
        $requestPath = parse_url($requestUri, PHP_URL_PATH);

        // --- Suporte para _method override ---
        if (strtoupper($requestMethod) === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        } else {
            $requestMethod = strtoupper($requestMethod);
        }

        $routes = $this->routes[strtoupper($requestMethod)] ?? [];

        foreach ($routes as $route => $handler) {
            $pattern = preg_replace('/\{[a-zA-Z_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            $pattern = "@^" . $pattern . "$@";

            if (preg_match($pattern, $requestPath, $matches)) {
                array_shift($matches); // remove full match

                [$controller, $method] = explode(':', $handler);
                $controllerClass = $this->namespace . '\\' . $controller;

                if (!class_exists($controllerClass)) {
                    http_response_code(500);
                    echo "Controller $controllerClass not found.";
                    return;
                }

                $controllerInstance = new $controllerClass();

                if (!method_exists($controllerInstance, $method)) {
                    http_response_code(500);
                    echo "Method $method not found in controller $controllerClass.";
                    return;
                }

                call_user_func_array([$controllerInstance, $method], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "Route not found.";
    }
}
