<?php

namespace Core\View;

interface ViewInterface
{
  public function page(string $name, array $data = []): void;

  public function prepPath(string $name): string;

  public function component(string $name): void;
}
