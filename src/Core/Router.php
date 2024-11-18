<?php
declare(strict_types=1);

namespace App\Core;

use Closure;

class Router
{
    protected array $routes = [];
    protected ?Closure $notFoundHandler = null;

    public function get(string $path, callable $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    protected function addRoute(string $method, string $path, callable $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function setNotFoundHandler(Closure $handler): void
    {
        $this->notFoundHandler = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri]);
        } else {
            if ($this->notFoundHandler) {
                call_user_func($this->notFoundHandler);
            } else {
                header("HTTP/1.0 404 Not Found");
                echo "404 Not Found";
            }
        }
    }
}
