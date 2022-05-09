<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_grade')->insert(['grade_name' => 'XCIX']);
        DB::table('tbl_grade')->insert(['grade_name' => 'I']);
        DB::table('tbl_grade')->insert(['grade_name' => 'II']);
        DB::table('tbl_grade')->insert(['grade_name' => 'III']);
        DB::table('tbl_grade')->insert(['grade_name' => 'IV']);
        DB::table('tbl_grade')->insert(['grade_name' => 'V']);
        DB::table('tbl_grade')->insert(['grade_name' => 'VI']);
        DB::table('tbl_grade')->insert(['grade_name' => 'VII']);
        DB::table('tbl_grade')->insert(['grade_name' => 'VIII']);
        DB::table('tbl_grade')->insert(['grade_name' => 'IX']);
        DB::table('tbl_grade')->insert(['grade_name' => 'X']);
    }
}
