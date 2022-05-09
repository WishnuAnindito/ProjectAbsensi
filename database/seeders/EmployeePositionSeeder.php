<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emp_position')->insert([
            'emp_id' => 2,
            'emp_department' => 2,
            'emp_division' => 9,
            'emp_position' => 19,
            'emp_grade' => 2,
            'emp_coach' => 3,
            'emp_manager' => 4,
            'emp_status' => 2,
        ]);
    }
}
