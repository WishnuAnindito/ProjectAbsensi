<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Division;
use App\Models\Position;
use App\Models\User;
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
        $faker = Faker::create();
        $department = Department::all()->pluck('dept_id')->toArray();
        $division = Division::all()->pluck('division_id')->toArray();
        $position = Position::all()->pluck('pos_id')->toArray();
        $leader = User::whereIn('user_grade', [5, 6, 7])->pluck('emp_id')->toArray();
        $data = DB::table('tbl_users')->select('emp_id', 'user_grade')->get();
        $status = [1, 2, 3];


        foreach ($data as $emp) {
            DB::table('emp_position')->insert([
                'emp_id' => $emp->emp_id,
                'emp_department' => $faker->randomElement($department),
                'emp_division' => $faker->randomElement($division),
                'emp_post' => $faker->randomElement($position),
                'emp_grade' => $emp->user_grade,
                'emp_coach' => $faker->randomElement($leader),
                'emp_manager' => $faker->randomElement($leader),
                'emp_status' => $faker->randomElement($status),
            ]);
        }
    }
}
