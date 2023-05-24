<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string $good_img
 * @property mixed|string $good_new_price
 * @property mixed|string $good_old_price
 * @property mixed $good_category
 * @property mixed|string $good_info
 */
class Goodsku extends Model
{
    use HasFactory;
    protected $table = 'goodsku';
}
