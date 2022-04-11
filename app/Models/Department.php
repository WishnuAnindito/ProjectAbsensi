<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'tbl_department';

    public function empPost(){
        return $this->hasMany(EmpPost::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }

    protected $fillable = [
        'dept_code',
        'dept_name',
        'dept_division'
    ];

    protected $hidden = [];

    protected $casts = [];
}
