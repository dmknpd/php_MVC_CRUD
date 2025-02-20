<?php

namespace Core\Model;

use Core\Database\Database;
use Core\Database\DatabaseInterface;

abstract class Model implements ModelInterface
{
  protected static string $table;

  protected static function db(): DatabaseInterface
  {
    return Database::getInstance();
  }

  public static function find(int $id): ?array
  {
    return self::db()->select(static::$table, ['id' => $id]);
  }

  public static function all(): array
  {
    return self::db()->selectAll(static::$table);
  }

  public static function allWithJoin(string $joinTable, string $onCondition, array $columns = [], array $conditions = [], string $orderBy = 'id', string $direction = "DESC"): array
  {
    return self::db()->selectAllWithJoin(
      static::$table,
      $joinTable,
      $onCondition,
      $columns,
      $conditions,
      $orderBy,
      $direction
    );
  }

  public static function create(array $data): int
  {
    return self::db()->insert(static::$table, $data);
  }

  public static function update(int $id, array $data): bool
  {
    return self::db()->update(static::$table, $data, ['id' => $id]);
  }

  public static function delete(int $id): bool
  {
    return self::db()->delete(static::$table, ['id' => $id]);
  }
}
