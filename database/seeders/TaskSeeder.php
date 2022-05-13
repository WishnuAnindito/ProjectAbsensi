<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $ind = CarbonImmutable::now()->locale('id');

        $startTime = Carbon::parse('08:00:00');
        $endTime = Carbon::parse('22:00:00');

        $leader = User::where('user_grade', 'IN', [5,6,7])->pluck('emp_id')->toArray();
        $employee = User::where('user_grade', 'IN', [2,3,4])->pluck('emp_id')->toArray();
        $emp_status = ['None', 'Check In', 'Clear'];
        $lead_status = ['Waiting for Review', 'Approved'];

        for($i = 0; $i < 100; $i++){
            DB::table('tbl_task')->insert([
                'task_assign_by' => $faker->randomElement($leader),
                'task_assign_to' => $faker->randomElement($employee),
                'task_name' => $faker->text,
                'task_date' => $faker->dateTimeBetween('-30 days', '+30 days'),
                'task_start_time' => $faker->time('H:i:s', $startTime),
                'task_end_time' => $faker->time('H:i:s', $endTime),
                'task_zone_time' => $faker->timezone(),
                'task_address' => $faker->streetAddress(),
                'task_city' => $faker->city(),
                'task_emp_status' => $faker->randomElement($emp_status),
                'task_lead_status' => $faker->randomElement($lead_status),
            ]);
        }
    }
}
