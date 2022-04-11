<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'tbl_division';

    public function department(){
       return $this->hasMany(Department::class);
    }

    public function empPost(){
        return $this->hasMany(Division::class);
    }

    protected $fillable = [
        'division_name'
    ];

    protected $hidden = [];

    protected $casts = [];
}
