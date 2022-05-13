<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $employee = Employee::where('emp_id', '!=', 1)->get();
        $grade = Grade::where('grade_id', '!=', 1)->pluck('grade_id')->toArray();

       
        if(User::all()->count() == null){
            DB::table('tbl_users')->insert([
                'emp_id' => 'Kang Mas Admin',
                'user_name' => 'admin@mitrakom.co.id',
                'user_pass' => bcrypt('tangara'),
                'user_grade' => 1
            ]);
        }else{
            foreach($employee as $emp){
                DB::table('tbl_users')->insert([
                    'emp_id' => $emp->emp_id,
                    'user_name' => $emp->emp_email_office,
                    'user_pass' => bcrypt('password'),
                    'user_grade' => $faker->randomElement($grade)
                ]);
            }
        }
        
    }
}
