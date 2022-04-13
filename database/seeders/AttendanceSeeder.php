<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_attendance')->insert([
            'att_name' => 'Izin'
        ]);
        DB::table('tbl_attendance')->insert([
            'att_name' => 'Cuti'
        ]);
        DB::table('tbl_attendance')->insert([
            'att_name' => 'Sakit'
        ]);
        DB::table('tbl_attendance')->insert([
            'att_name' => 'Tanpa Keterangan'
        ]);
        DB::table('tbl_attendance')->insert([
            'att_name' => 'Terlambat'
        ]);
    }
}
