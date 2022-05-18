<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absen';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'abs_emp_id', 'emp_id');
    }

    public function absenIn()
    {
        return $this->belongsTo(AbsenIn::class, 'abs_in_id', 'abs_in_id');
    }

    public function absenOut()
    {
        return $this->belongsTo(AbsenOut::class, 'abs_out_id', 'abs_out_id');
    }

    protected $fillable = [
        'abs_emp_id',
        'abs_date',
        'abs_in_id',
        'abs_out_id'
    ];

    protected $hidden = [];

    protected $casts = [];
}
