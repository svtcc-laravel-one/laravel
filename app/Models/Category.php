<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed $parent_id
 * @property mixed|string $category_name
 * @property mixed $id
 */
class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
}
