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

  public function insert(string $table, array $data): int|false {}

  private function connect()
  {
    $driver = $this->config->get('database.driver');
    $host = $this->config->get('database.host');
    $port = $this->config->get('database.port');
    $dbname = $this->config->get('database.dbname');
    $charset = $this->config->get('database.charset');
    $username = $this->config->get('database.username');
    $password = $this->config->get('database.password');

    try {
      $this->pdo = new PDO(
        "{$driver}:host={$host};port={$port};dbname={$dbname};charset={$charset}",
        $username,
        $password
      );
    } catch (PDOException $e) {
      exit("Database connection failed: {$e->getMessage()}");
    }
  }
}
