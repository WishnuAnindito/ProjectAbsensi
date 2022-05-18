<?php

namespace Database\Seeders;

use App\Models\AbsenOut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abs_out = AbsenOut::all();

        foreach ($abs_out as $abs) {
            DB::table('absen')->insert([
                'abs_emp_id' => $abs->abs_emp_id,
                'abs_date' => $abs->abs_date,
                'abs_in_id' => $abs->abs_in_id,
                'abs_out_id' => $abs->abs_out_id
            ]);
        }
    }
}
