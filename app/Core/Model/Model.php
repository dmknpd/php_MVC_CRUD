<?php

namespace Core\Model;

use Core\Database\DatabaseInterface;

abstract class Model
{
  protected static string $table = '';

  public function __construct(
    protected DatabaseInterface $db
  ) {}

  public function all(): array
  {
    $sql = "SELECT * FROM " . static::$table;

    return $this->db->query($sql);
  }
}
