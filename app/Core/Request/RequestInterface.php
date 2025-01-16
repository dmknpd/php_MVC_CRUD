<?php

namespace Core\Request;

use Core\Validator\ValidatorInterface;

interface RequestInterface
{
  public static function createFromGlobals(ValidatorInterface $validator): static;

  public function uri(): string;

  public function method(): string;

  // public function input(string $key, $default = null): mixed;
  public function post(): array;

  public function validate(array $data, array $rules): bool;

  public function filteredData(): array;

  public function errors(): array;
}
