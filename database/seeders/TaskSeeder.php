<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_task')->insert([
            'task_assign_by' => 3,
            'task_assign_to' => 2,
            'task_name' => 'Pemasangan Kabel Jaringan di Jakarta',
            'task_date' => Carbon::parse('2022-05-09'),
            'task_start_time' => Carbon::parse('10:00:00'),
            'task_end_time' => Carbon::parse('13:00:00'),
            'task_zone_time' => 'WIB',
            'task_address' => 'Jl. Jenderal Sudirman No.Kav 1, RT.1/RW.3, Gelora, Tanah Abang, Central Jakarta City, Jakarta 10270',
            'task_city' => 'Jakarta',
            'task_emp_status' => 'Clear',
            'task_lead_status' => 'Waiting for Review',
        ]);

        DB::table('tbl_task')->insert([
            'task_assign_by' => 3,
            'task_assign_to' => 2,
            'task_name' => 'Pemasangan Kabel Jaringan di Bogor',
            'task_date' => Carbon::parse('2022-05-09'),
            'task_start_time' => Carbon::parse('15:00:00'),
            'task_end_time' => Carbon::parse('18:00:00'),
            'task_zone_time' => 'WIB',
            'task_address' => 'RW 02, Babakan Pasar, Bogor Tengah, Bogor City, West Java',
            'task_city' => 'Bogor',
            'task_emp_status' => 'None',
            'task_lead_status' => 'Waiting for Review',
        ]);
    }
}
