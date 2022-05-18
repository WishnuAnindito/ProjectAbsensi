<?php

namespace Database\Seeders;

use App\Models\AbsenIn;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AbsenOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $startTime = Carbon::parse('08:00:00');
        $abs_in = AbsenIn::all();
        $status = ['On Time', 'Leave Earlier'];

        foreach ($abs_in as $abs) {
            DB::table('abs_out')->insert([
                'abs_emp_id' => $abs->abs_emp_id,
                'abs_in_id' => $abs->abs_in_id,
                'abs_date' => $abs->abs_date,
                'abs_time' => $faker->time('H:i:s', $startTime),
                'abs_reason' => $faker->text,
                'abs_longitude_out' => $faker->longitude(-90, 90),
                'abs_latitude_out' => $faker->latitude(-90, 90),
                'abs_address_out' => $abs->abs_address_in,
                'abs_zone_region_out' => $abs->abs_zone_region_in,
                'abs_zone_time_out' => $abs->abs_zone_time_in,
                'status_check_out' => $faker->randomElement($status),
            ]);
        }
    }
}
