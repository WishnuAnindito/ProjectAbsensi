<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmpPost;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmployeePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $employee = Employee::all()->pluck('emp_id')->toArray();
        $coach = User::where('user_grade', 'IN', [4,5])->pluck('emp_id')->toArray();
        $manager = User::where('user_grade', '=', 6)->pluck('emp_id')->toArray();
        $department = Department::all()->pluck(['dept_id','dept_division'])->toArray();
        $position = Position::all()->pluck('pos_id')->toArray();
        $status = [1,2];

        foreach ($employee as $emp){
            if(EmpPost::all()->count() == null){
                // Admin
                DB::table('emp_position')->insert([
                    'emp_id' => 1,
                    'emp_department' => 2,
                    'emp_division' => 9,
                    'emp_position' => 19,
                    'emp_grade' => 1,
                    'emp_coach' => 3,
                    'emp_manager' => 4,
                    'emp_status' => 2,
                ]);
            }else{
                DB::table('emp_position')->insert([
                    'emp_id' => $emp,
                    'emp_department' => $faker->randomElement($department['dept_id']),
                    'emp_division' => $faker->randomElement($department['dept_division']),
                    'emp_position' => $faker->randomElement($position),
                    'emp_grade' => 2,
                    'emp_coach' => $faker->randomElement($coach),
                    'emp_manager' => $faker->randomElement($manager),
                    'emp_status' => $faker->randomElement($status)
                ]);
            }
        }
        
    }
}
