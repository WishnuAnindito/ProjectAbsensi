<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenOut extends Model
{
    protected $table = 'abs_out';

    public function absen(){
        return $this->hasOne(Absen::class, 'abs_out_id', 'abs_out_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'abs_emp_id', 'emp_id');
    }

    public function absenIn(){
        return $this->belongsTo(absenIn::class, 'abs_in_id', 'abs_in_id');
    }

    protected $fillable = [
        'abs_emp_id',
        'abs_in_id',
        'abs_date',
        'abs_time',
        'abs_reason',
        'abs_latitude_out',
        'abs_longitude_out',
        'abs_address_out',
        'abs_zone_region_out',
        'abs_zone_time_out',
        'status_check_out'
    ];

    protected $hidden = [];

    protected $casts = [];
}
