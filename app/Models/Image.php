<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'emp_image';

    protected $fillable = [
        'emp_id',
        'emp_img_file',
        'emp_img_name',
        'emp_img_desc',
    ];

   
    protected $hidden = [];

   
    protected $casts = [];
}
