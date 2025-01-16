<?php

namespace Core\Database;

interface DatabaseInterface
{
  public function query(string $sql, array $params = []): array;

  public function insert(string $table, array $data): int|false;
}
