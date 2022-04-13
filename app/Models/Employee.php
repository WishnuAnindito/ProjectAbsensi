<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable;

    protected $table = 'emp_person';

    public function getRouteKeyName()
    {
        return 'name';
    }

    

    public function absen(){
        return $this->hasMany(Absen::class);
    }
    
    public function absenIn(){
        return $this->hasMany(AbsenIn::class);
    }

    public function absenOut(){
        return $this->hasMany(AbsenOut::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function department(){
        return $this->hasMany(Department::class);
    }

    public function division(){
        return $this->hasMany(Division::class);
    }
    
    public function position(){
        return $this->hasMany(Position::class);
    }

    public function empPost(){
        return $this->hasOne(EmpPost::class);
    }

    protected $fillable = [
        'emp_full_name',
        'emp_birth_date',
        'emp_email_office',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [];

}
