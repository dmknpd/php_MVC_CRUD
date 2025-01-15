<?php

namespace Core\View;

use Core\Exceptions\ViewNotFoundException;
use Core\Session\SessionInterface;
use InvalidArgumentException;

class View implements ViewInterface
{

  public function __construct(
    private SessionInterface $session
  ) {}

  public function page(string $name): void
  {
    $filePath = $this->prepPath($name);

    if (!file_exists($filePath)) {
      throw new ViewNotFoundException("View not found: {$filePath}");
    }

    extract([
      'view' => $this,
      'session' => $this->session
    ]);

    include_once $filePath;
  }

  public function prepPath(string $name): string
  {
    if (strpos($name, '..') !== false) {
      throw new InvalidArgumentException("Invalid path: '{$name}'");
    }

    [$folder, $file] = explode('.', $name);

    if ($file === null) {
      throw new InvalidArgumentException("Invalid page name.");
    }

    return APP_PATH . "/resources/views/{$folder}/{$file}.php";
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
