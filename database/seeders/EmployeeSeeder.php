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
        $name = ['Admin', 'Wishnu Anindito', 'Toni Sembiring', 'Dadan Hudaya', 'Wishnu', 'Toni', 'Dadan'];
        $birthdate = ['2000-02-02', '1999-09-19', '1980-08-08', '1985-05-05', '1991-06-06', '1990-06-07', '1995-08-08'];
        $email = ['admin@gmail.com', 'wishnuanindito123@gmail.com', 'sembiringtoni123@gmail.com', 'dadanhudaya@mitrakom.co.id', 'wishnu@mitrakom.co.id', 'toni@mitrakom.co.id', 'dadan@mitrakom.co.id'];
        $i = 0;
        
        foreach ($name as $nama){
            DB::table('emp_person')->insert([
                'emp_full_name' => $nama,
                'emp_birth_date' => Carbon::parse($birthdate[$i]),
                'emp_email_office' => $email[$i]
            ]);
            $i++;
        }

        // DB::table('emp_person')->insert([
        //     'emp_full_name' => 'Admin',
        //     'emp_birth_date' => Carbon::parse('2000-02-02'),
        //     'emp_email_office' => 'admin@mitrakom.co.id'
        // ]);
        // DB::table('emp_person')->insert([
        //     'emp_full_name' => 'Wishnu Anindito',
        //     'emp_birth_date' => Carbon::parse('1999-09-19'),
        //     'emp_email_office' => 'wishnu@mitrakom.co.id'
        // ]);
        // DB::table('emp_person')->insert([
        //     'emp_full_name' => 'Toni Sembiring',
        //     'emp_birth_date' => Carbon::parse('1980-08-08'),
        //     'emp_email_office' => 'rrg@mitrakom.co.id'
        // ]);
        // DB::table('emp_person')->insert([
        //     'emp_full_name' => 'Dadan Hudaya',
        //     'emp_birth_date' => Carbon::parse('1985-05-05'),
        //     'emp_email_office' => 'dadan@mitrakom.co.id'
        // ]);
    }
}
