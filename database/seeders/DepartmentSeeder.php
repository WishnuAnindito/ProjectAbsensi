<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $code = ['BOD','BS','BK','FA','HR','OPR','LEG','MPU','GA','SD','PD','PRO','MR','SM','SVC','LOG','WS','BU','NIX','BIT'];
        $name = ['Board Of Director', 'Billing Support', 'Banking', 'Finance & Accounting', 
        'Human Resource','HUB Operation','Legal','MP Upgrade', 'General Affair','Services Delivery',
        'Product Development','Purchasing','QMR','Sales & Marketing','Services','Warehouse & Logistic',
        'Workshop','Business Support','NIX','Bitnet'];
        $division = [11,10,8,1,2,10,8,8,2,8,7,16,12,5,8,4,14,1,8,13];
        $i = 0;

        foreach ($code as $dpt_code){
            DB::table('tbl_department')->insert([
                'dept_code' => $dpt_code,
                'dept_name' => $name[$i],
                'dept_division' => $division[$i]
            ]);
            $i++;
        }
    }
}
