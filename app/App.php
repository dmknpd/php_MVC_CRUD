<?php

namespace App;

use Core\Container\Container;

class App
{
  private Container $container;

  public function __construct()
  {
    $this->container = new Container();
  }

  public function run(): void
  {
    $router = $this->container->router;
    $request = $this->container->request;

    $uri = $request->uri();
    $method = $request->method();

    $router->dispatch($uri, $method);
  }
}
