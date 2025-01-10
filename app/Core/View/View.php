<?php

namespace Core\View;

use InvalidArgumentException;
use RuntimeException;

class View
{

  public function page(string $name): void
  {
    $filePath = $this->prepPath($name);

    if (!file_exists($filePath)) {
      throw new RuntimeException("Файл не найден: {$filePath}");
    }

    include_once $filePath;
  }

  public function prepPath(string $name): string
  {
    if (strpos($name, '..') !== false) {
      throw new InvalidArgumentException("Недопустимый путь: '{$name}'");
    }

    $path = explode('.', $name);

    if (count($path) < 2) {
      throw new InvalidArgumentException("Неверный формат имени страницы.");
    }

    return APP_PATH . "/resources/views/{$path[0]}/{$path[1]}.php";
  }
}
