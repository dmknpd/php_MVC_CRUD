<?php

namespace Core\Database;

use Core\Config\Config;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
  private static ?self $instance = null;
  private PDO $pdo;

  private function __construct()
  {
    $config = Config::getInstance();

    $driver = $config->get('database.driver');
    $host = $config->get('database.host');
    $port = $config->get('database.port');
    $database = $config->get('database.database');
    $charset = $config->get('database.charset');
    $username = $config->get('database.username');
    $password = $config->get('database.password');

    $dsn = "{$driver}:host={$host};port={$port};dbname={$database};charset={$charset}";

    try {
      $this->pdo = new PDO(
        $dsn,
        $username,
        $password,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
      );
    } catch (PDOException $e) {
      die("Ошибка подключения к БД: " . $e->getMessage());
    }
  }

  public static function getInstance(): self
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function getConnection(): PDO
  {
    return $this->pdo;
  }

  public function select(string $table, array $conditions = []): ?array
  {
    $where = '';
    $params = [];

    if (!empty($conditions)) {
      $where = 'WHERE ' . implode(' AND ', array_map(fn($key) => "{$key} = :{$key}", array_keys($conditions)));
    }

    $sql = "SELECT * FROM {$table} {$where} LIMIT 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch();

    return $result ?: null;
  }

  public function selectAll(string $table, array $conditions = []): array
  {
    $where = '';
    $params = [];

    if (!empty($conditions)) {
      $where = 'WHERE ' . implode(' AND ', array_map(fn($key) => "{$key} = :{$key}", array_keys($conditions)));
    }

    $sql = "SELECT * FROM {$table} {$where}";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }

  public function insert(string $table, array $data): int
  {
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));

    $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);

    return (int) $this->pdo->lastInsertId();
  }

  public function update(string $table, array $data, array $conditions): bool
  {
    $set = implode(', ', array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
    $where = implode(' AND ', array_map(fn($key) => "{$key} = :cond_{$key}", array_keys($conditions)));

    $params = array_merge($data, array_combine(
      array_map(fn($key) => "cond_{$key}", array_keys($conditions)),
      array_values($conditions)
    ));

    $sql = "UPDATE {$table} SET {$set} WHERE {$where}";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($params);
  }

  public function delete(string $table, array $conditions): bool
  {
    $where = implode(' AND ', array_map(fn($key) => "{$key} = :{$key}", array_keys($conditions)));
    $sql = "DELETE FROM {$table} WHERE {$where}";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($conditions);
  }
}
