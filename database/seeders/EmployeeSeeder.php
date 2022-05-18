<?php

namespace Database\Seeders;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            if (Employee::all()->count() == null) {
                DB::table('emp_person')->insert([
                    'emp_full_name' => 'Kang Mas Admin',
                    'emp_birth_date' =>  Carbon::parse('1987-05-09'),
                    'emp_phone' => '081234567890',
                    'emp_email_office' => 'admin@mitrakom.co.id'
                ]);
            } else {
                DB::table('emp_person')->insert([
                    'emp_full_name' => $faker->name(),
                    'emp_birth_date' =>  $faker->date('Y-m-d', '1990-12-31'),
                    'emp_phone' => $faker->phoneNumber,
                    'emp_email_office' => $faker->safeEmail()
                ]);
            }
        }
    }
}
