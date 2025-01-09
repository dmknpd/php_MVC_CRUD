<?php

namespace App\Router;

class Router
{

  private array $routes = [
    'GET' => [],
    'POST' => []
  ];

  public function __construct()
  {
    $this->initRoutes();
  }

  private function initRoutes()
  {
    $routes = $this->getRoutes();

    foreach ($routes as $route) {
      $this->routes[$route->getMethod()][$route->getUri()] = $route;
    }
  }

  /**
   * @return Route[]
   */

  private function getRoutes(): array
  {
    return require_once APP_PATH . '/routes/routes.php';
  }


  public function dispatch(string $uri, string $method): void
  {
    $route = $this->findRoute($uri, $method);

    if (!$route) {
      $this->notFound();
    }

    if (is_array($route->getAction())) {
      [$controller, $action] = $route->getAction();

      $controller = new $controller();

      call_user_func([$controller, $action]);
    } else {
      call_user_func($route->getAction());
    }
  }

  private function findRoute(string $uri, string $method): Route|false
  {
    return $this->routes[$method][$uri] ?? false;
  }

  private function notFound(): void
  {
    echo '<h1>404 | Not Found</h1>';
    exit;
  }
}
