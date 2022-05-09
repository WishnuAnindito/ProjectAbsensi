<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tbl_task';
    protected $connection = 'mysql';

    protected $fillable = [
        'task_assign_by',
        'task_assign_to',
        'task_name',
        'task_date',
        'task_start_time',
        'task_end_time',
        'task_zone_time',
        'task_address',
        'task_city',
    ];

   
    protected $hidden = [];

   
    protected $casts = [];

}
