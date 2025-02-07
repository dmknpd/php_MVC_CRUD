<?php

namespace Core\Router;

class Route
{
  private array $params = [];

  public function __construct(
    private string $uri,
    private string $method,
    private $action,
    private array $middlewares = []

  ) {}

  public static function get(string $uri, $action, array $middlewares = []): static
  {
    return new static($uri, "GET", $action, $middlewares);
  }

  public static function post(string $uri, $action, array $middlewares = []): static
  {
    return new static($uri, "POST", $action, $middlewares);
  }

  public function getUri(): string
  {
    return $this->uri;
  }

  public function getMethod(): string
  {
    return $this->method;
  }

  public function getAction()
  {
    return $this->action;
  }

  public function getMiddlewares(): array
  {
    return $this->middlewares;
  }

  public function hasMiddlewares(): bool
  {
    return ! empty($this->middlewares);
  }

  public function match(string $uri): bool
  {
    $pattern = preg_replace('/\{([\w]+)\}/', '(?P<$1>[^/]+)', $this->uri);
    $pattern = "#^" . $pattern . "$#";

    if (preg_match($pattern, $uri, $matches)) {
      foreach ($matches as $key => $match) {
        if (!is_int($key)) {
          $this->params[$key] = $match;
        }
      }
      return true;
    }
    return false;
  }

  public function getParams(): array
  {
    return $this->params;
  }
}
