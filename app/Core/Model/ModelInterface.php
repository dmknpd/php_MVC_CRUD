<?php

namespace Core\Model;

use Core\Database\DatabaseInterface;

interface ModelInterface
{
  public static function find(int $id): ?array;

  public static function all(): array;

  public static function create(array $data): int;

  public static function update(int $id, array $data): bool;

  public static function delete(int $id): bool;
}
