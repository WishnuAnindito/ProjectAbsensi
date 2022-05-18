<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpPost extends Model
{
    protected $table = 'emp_position';

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function department()
    {
        return $this->hasMany(Department::class);
    }

    public function division()
    {
        return $this->hasMany(Division::class);
    }

    public function position()
    {
        return $this->hasMany(Position::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    protected $fillable = [
        'emp_id',
        'emp_department',
        'emp_division',
        'emp_post',
        'emp_grade',
        'emp_coach',
        'emp_manager',
        'emp_status',
    ];

    protected $hidden = [];

    protected $casts = [];
}
