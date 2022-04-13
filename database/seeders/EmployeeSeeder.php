<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emp_person')->insert([
            'emp_full_name' => 'Admin',
            'emp_birth_date' => Carbon::parse('2000-02-02'),
            'emp_email_office' => 'admin@mitrakom.co.id'
        ]);
        DB::table('emp_person')->insert([
            'emp_full_name' => 'Wishnu Anindito',
            'emp_birth_date' => Carbon::parse('1999-09-19'),
            'emp_email_office' => 'wishnu@mitrakom.co.id'
        ]);
        DB::table('emp_person')->insert([
            'emp_full_name' => 'Toni Sembiring',
            'emp_birth_date' => Carbon::parse('1980-08-08'),
            'emp_email_office' => 'rrg@mitrakom.co.id'
        ]);
        DB::table('emp_person')->insert([
            'emp_full_name' => 'Dadan Hudaya',
            'emp_birth_date' => Carbon::parse('1985-05-05'),
            'emp_email_office' => 'dadan@mitrakom.co.id'
        ]);
    }
}
