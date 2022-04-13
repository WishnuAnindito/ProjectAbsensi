<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_division')->insert([
            'division_name' => 'Finance'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'HRGA'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'NOC'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Logistic'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Marketing'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Operation VSAT'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Product'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Services'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Help Desk'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Admin Hub'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'BOD'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'QMR'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Bitnet'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Workshop'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'EOS'
        ]);
        DB::table('tbl_division')->insert([
            'division_name' => 'Purchasing'
        ]);
    }
}
