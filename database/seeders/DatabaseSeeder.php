<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EmployeeSeeder::class,
            DivisionSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            GradeSeeder::class,
            UserSeeder::class,
            EmployeePositionSeeder::class,
            TaskSeeder::class,
            AbsenInSeeder::class,
            AbsenOutSeeder::class,
            AbsenSeeder::class,
        ]);
    }
}
