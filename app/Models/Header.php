<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ppb_header';
}
