<?php

namespace Core\View;

use Core\Exceptions\ViewNotFoundException;
use InvalidArgumentException;
use RuntimeException;

class View
{

  public function page(string $name): void
  {
    $filePath = $this->prepPath($name);

    if (!file_exists($filePath)) {
      throw new ViewNotFoundException("View not found: {$filePath}");
    }

    extract([
      'view' => $this
    ]);

    include_once $filePath;
  }

  public function prepPath(string $name): string
  {
    if (strpos($name, '..') !== false) {
      throw new InvalidArgumentException("Invalid path: '{$name}'");
    }

    $path = explode('.', $name);

    if (count($path) < 2) {
      throw new InvalidArgumentException("Invalid page name.");
    }

    return APP_PATH . "/resources/views/{$path[0]}/{$path[1]}.php";
  }

  public function component(string $name): void
  {

    $filePath = APP_PATH . "/resources/views/components/{$name}.php";

    if (!file_exists($filePath)) {
      echo "Component not found: {$filePath}";
      return;
    }

    include_once $filePath;
  }
}
