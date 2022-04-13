<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_users')->insert([
            'user_name' => 'admin@mitrakom.co.id',
            'user_pass' => bcrypt('Tangara'),
            'user_grade' => 99
        ]);

        DB::table('tbl_users')->insert([
            'user_name' => 'wishnu@mitrakom.co.id',
            'user_pass' => bcrypt('password'),
            'user_grade' => 2
        ]);

        DB::table('tbl_users')->insert([
            'user_name' => 'rrg@mitrakom.co.id',
            'user_pass' => bcrypt('password'),
            'user_grade' => 2
        ]);
        
        DB::table('tbl_users')->insert([
            'user_name' => 'dadan@mitrakom.co.id',
            'user_pass' => bcrypt('password'),
            'user_grade' => 4
        ]);
    }
}
