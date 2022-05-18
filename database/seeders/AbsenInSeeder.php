<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AbsenInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $today = Carbon::now();
        $startTime = Carbon::parse('08:00:00');

        $task = Task::whereDate('task_date', '<=', $today)->get();
        $status = ['On Time', 'Late'];

        foreach ($task as $tsk) {
            DB::table('abs_in')->insert([
                'task_id' => $tsk->task_id,
                'abs_emp_id' => $tsk->task_assign_to,
                'abs_date' => $tsk->task_date,
                'abs_time' => $faker->time('H:i:s', $startTime),
                'abs_reason' => $faker->text,
                'abs_longitude_in' => $faker->longitude(-90, 90),
                'abs_latitude_in' => $faker->latitude(-90, 90),
                'abs_address_in' => $tsk->task_address,
                'abs_zone_region_in' => $tsk->task_city,
                'abs_zone_time_in' => $tsk->task_zone_time,
                'status_check_in' => $faker->randomElement($status),
            ]);
        }
    }
}
