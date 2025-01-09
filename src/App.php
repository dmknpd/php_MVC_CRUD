<?php

namespace App;

use App\Http\Request;
use App\Router\Router;

class App
{
  public function run(): void
  {
    $router = new Router();
    $request = Request::createFromGlobals();

    $uri = $request->uri();
    $method = $request->method();

    $router->dispatch($uri, $method);
  }
}
