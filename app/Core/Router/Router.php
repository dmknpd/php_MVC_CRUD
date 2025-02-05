<?php

namespace Core\Router;

use Core\Auth\AuthInterface;
use Core\Database\DatabaseInterface;
use Core\Redirect\RedirectInterface;
use Core\Request\RequestInterface;
use Core\Session\SessionInterface;
use Core\View\ViewInterface;

class Router implements RouterInterface
{

  private array $routes = [
    'GET' => [],
    'POST' => []
  ];

  public function __construct(
    private ViewInterface $view,
    private RequestInterface $request,
    private RedirectInterface $redirect,
    private SessionInterface $session,
  ) {
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

    // if ($route->hasMiddlewares()) {
    //   foreach ($route->getMiddlewares() as $middleware) {
    //     $middleware = new $middleware($this->request, $this->redirect);

    //     $middleware->handle();
    //   }
    // }

    if (is_array($route->getAction())) {
      [$controller, $action] = $route->getAction();

      $controller = new $controller(
        $this->view,
        $this->request,
        $this->redirect,
        $this->session,
      );

      // call_user_func([$controller, $action]);
      $controller->$action();
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
