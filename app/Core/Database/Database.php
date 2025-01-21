<?php

namespace Core\Database;

use Core\Config\ConfigInterface;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
  private PDO $pdo;

  public function __construct(
    private ConfigInterface $config
  ) {
    $this->connect();
  }

  public function insert(string $table, array $data): int|false
  {
    $fields = array_keys($data);

    $columns = implode(', ', $fields);
    $binds = implode(', ', array_map(fn($field) => ":{$field}", $fields));

    $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$binds})";
    $stmt = $this->pdo->prepare($sql);

    if ($stmt->execute($data)) {
      return (int) $this->pdo->lastInsertId();
    }

    return false;
  }

  public function first(string $table, array $conditions = []): ?array
  {
    $where = '';

    if (count($conditions) > 0) {
      $where = 'WHERE ' . implode(' AND ', array_map(fn($field) => "{$field} = :{$field}", array_keys($conditions)));
    }

    $sql = "SELECT * FROM {$table} {$where} LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute($conditions);

    $result = $stmt->fetch();

    return $result ?: null;
  }

  private function connect()
  {
    $driver = $this->config->get('database.driver');
    $host = $this->config->get('database.host');
    $port = $this->config->get('database.port');
    $database = $this->config->get('database.database');
    $charset = $this->config->get('database.charset');
    $username = $this->config->get('database.username');
    $password = $this->config->get('database.password');

    try {
      $this->pdo = new PDO(
        "{$driver}:host={$host};port={$port};dbname={$database};charset={$charset}",
        $username,
        $password,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
      );
    } catch (PDOException $e) {
      exit("Database connection failed: {$e->getMessage()}");
    }
  }
}
