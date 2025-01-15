<?php

namespace Core\Router;

interface RouterInterface
{
  public function dispatch(string $uri, string $method): void;
}
