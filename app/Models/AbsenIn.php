<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenIn extends Model
{
    protected $table = 'abs_in';

    public function absen(){
        return $this->hasOne(Absen::class, 'abs_in_id', 'abs_in_id');
    }
    
    public function absenOut(){
        return $this->hasOne(AbsenOut::class, 'abs_in_id', 'abs_in_id');
    }
    
    public function employee(){
        return $this->belongsTo(Employee::class, 'abs_emp_id', 'emp_id');
    }

    protected $fillable = [
        'abs_emp_id',
        'abs_date',
        'abs_time',
        'abs_reason',
        'abs_latitude_in',
        'abs_longitude_in',
        'abs_address_in',
        'abs_zone_region_in',
        'abs_zone_time_in',
        'status_check_in'
    ];

    protected $hidden = [];

    protected $casts = [];
}
