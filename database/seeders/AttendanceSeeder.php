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
        $status = ['Izin','Cuti','Sakit','Tanpa Keterangan','Terlambat'];
        foreach ($status as $stat){
            DB::table('tbl_attendance')->insert([
                'att_name' => $stat
            ]);
        }
    }
}
