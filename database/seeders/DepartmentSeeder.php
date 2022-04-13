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
        DB::table('tbl_department')->insert([
            'dept_code' => 'BOD',
            'dept_name' => 'Board Of Director',
            'dept_division' => 11
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'BS',
            'dept_name' => 'Billing Support',
            'dept_division' => 10
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'BK',
            'dept_name' => 'Banking',
            'dept_division' => 8
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'FA',
            'dept_name' => 'Finance & Accounting',
            'dept_division' => 1
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'HR',
            'dept_name' => 'Human Resource',
            'dept_division' => 2
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'OPR',
            'dept_name' => 'HUB Operation',
            'dept_division' => 10
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'LEG',
            'dept_name' => 'Legal',
            'dept_division' => 8
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'MPU',
            'dept_name' => 'MP Upgrade',
            'dept_division' => 8
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'GA',
            'dept_name' => 'General Affair',
            'dept_division' => 2
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'SD',
            'dept_name' => 'Services Delivery',
            'dept_division' => 8
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'PD',
            'dept_name' => 'Product Development',
            'dept_division' => 7
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'PRO',
            'dept_name' => 'Purchasing',
            'dept_division' => 16
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'MR',
            'dept_name' => 'QMR',
            'dept_division' => 12
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'SM',
            'dept_name' => 'Sales & Marketing',
            'dept_division' => 5
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'SVC',
            'dept_name' => 'Services',
            'dept_division' => 8
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'LOG',
            'dept_name' => 'Warehouse & Logistic',
            'dept_division' => 4
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'WS',
            'dept_name' => 'Workshop',
            'dept_division' => 14
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'BU',
            'dept_name' => 'Business Support',
            'dept_division' => 1
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'NIX',
            'dept_name' => 'NIX',
            'dept_division' => 8
        ]);
        DB::table('tbl_department')->insert([
            'dept_code' => 'BIT',
            'dept_name' => 'Bitnet',
            'dept_division' => 13
        ]);
    }
}
