<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected $table = 'tbl_users';
    protected $connection = 'mysql';

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
