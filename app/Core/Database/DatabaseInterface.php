<?php

namespace Core\Database;

interface DatabaseInterface
{
  public function getConnection(): \PDO;

  public function select(string $table, array $conditions = []): ?array;

  public function selectAll(string $table, array $conditions = []): array;

  public function selectAllWithJoin(string $table, string $joinTable, string $onCondition, array $columns = [], array $conditions = [], string $orderBy = 'id', string $direction = "DESC"): array;

  public function insert(string $table, array $data): int;

  public function update(string $table, array $data, array $conditions): bool;

  public function delete(string $table, array $conditions): bool;
}
