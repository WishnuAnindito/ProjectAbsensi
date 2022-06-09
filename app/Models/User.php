<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
    protected $table = 'tbl_users';
    protected $connection = 'mysql';
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected $fillable = [
        'emp_id',
        'user_name',
        'user_pass',
        'user_grade',
    ];


    protected $hidden = [
        'user_pass'
    ];

    protected $casts = [];
    
    public function getAuthPassword()
    {
        return $this->user_pass;
    }
}
