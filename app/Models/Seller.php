<?php

namespace App\Models;

use Core\Model\Model;

class Seller extends Model
{
  protected static string $table = 'sellers';

  public static function findByUserId(int $user_id): ?array
  {
    return self::db()->select(static::$table, ['user_id' => $user_id]);
  }
}
