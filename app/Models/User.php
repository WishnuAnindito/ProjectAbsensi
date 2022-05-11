<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use HasFactory;
    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    protected $table = 'tbl_users';
    protected $connection = 'mysql';

    protected $fillable = [
        'user_name',
        'user_pass',
        'user_grade',
    ];

   
    protected $hidden = [
        'user_pass'
    ];

   
    protected $casts = [];

    public function getAuthPassword() {
        return $this->user_pass;
    }
}
