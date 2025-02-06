<?php

namespace App\Models;

use Core\Model\Model;

class Plant extends Model
{
  protected static string $table = 'plants';

  public static function allWithSeller(): array
  {
    return self::allWithJoin(
      'sellers',
      'plants.seller_id = sellers.id',
      orderBy: 'plants.created_at'
    );
  }
}
