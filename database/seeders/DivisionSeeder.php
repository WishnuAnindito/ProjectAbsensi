<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $division = ['Finance','HRGA','NOC','Logistic','Marketing','Operation VSAT','Product',
        'Services','Help Desk','Admin Hub', 'BOD', 'QMR', 'Bitnet', 'Workshop', 'EOS', 'Purchasing'
        ];

        foreach ($division as $div){
            DB::table('tbl_division')->insert([
                'division_name' => $div
            ]);
        }
    }
}
