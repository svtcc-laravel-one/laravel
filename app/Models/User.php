<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 *  @property string $username
 *   @property string $password
 *
 */
class User extends Model
{
    protected $table = 'user';
    use HasFactory;
}
