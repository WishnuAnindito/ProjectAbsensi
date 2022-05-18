<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Account Manager', 'Administration Staff', 'Administrator Staff', 'Ass. Manager', 'Billing Support & Administrator SPV',
            'Computer Technician', 'Coordinator', 'Courier Staff', 'Deputi General Manager', 'Director', 'Driver', 'Electrical Sr. Staff', 'Engineer',
            'Engineer SPV', 'Head Of IT & Operation Bitnet', 'Helper', 'HR Staff', 'Jr.Engineer', 'Junior Project Administrator Staff', 'Manager',
            'Marketing Communication Staff', 'MP Upgrade Technician', 'MP Upgrade Technician Service Point Kendari', 'MP Upgrade Technician Service Point Samarinda',
            'MP Upgrade Technician SP Pontianak', 'Office Boy', 'Office Girl', 'Operator', 'Programmer', 'Project Management Officer', 'Purchasing Staff',
            'QC Technician', 'Receptcionis', 'Recruitment Specialist', 'Repair Technician', 'Report Administration Staff', 'Sales Executive', 'Secretary BOD',
            'Security', 'Security Ambon', 'Security Kupang', 'Security Manokwari', 'Security Mataram', 'Senior Staff', 'Shift Coordinator Senior Staff',
            'Staff', 'Supervisor', 'Teknisi GA', 'VSAT Technician', 'VSAT Technician Area Jakarta', 'VSAT Technician Jakarta Timur', 'VSAT Technician Service Point Aceh',
            'VSAT Technician Service Point Bali', 'VSAT Technician Service Point Balikpapan', 'VSAT Technician Service Point Bandung', 'VSAT Technician Service Point Banjarmasin',
            'VSAT Technician Service Point Batam', 'VSAT Technician Service Point Bekasi', 'VSAT Technician Service Point Bogor', 'VSAT Technician Service Point Cilegon',
            'VSAT Technician Service Point Cirebon', 'VSAT Technician Service Point Denpasar', 'VSAT Technician Service Point Depok', 'VSAT Technician Service Point Jakarta Barat',
            'VSAT Technician Service Point Jakarta Barat', 'VSAT Technician Service Point Jakarta Timur', 'VSAT Technician Service Point Jambi', 'VSAT Technician Service Point Jayapura',
            'VSAT Technician Service Point Jember', 'VSAT Technician Service Point Jogjakarta', 'VSAT Technician Service Point Kediri', 'VSAT Technician Service Point Kupang',
            'VSAT Technician Service Point Lampung', 'VSAT Technician Service Point Lombok', 'VSAT Technician Service Point Makassar', 'VSAT Technician Service Point Malang',
            'VSAT Technician Service Point Manado', 'VSAT Technician Service Point Medan', 'VSAT Technician Service Point Padang', 'VSAT Technician Service Point Palangkaraya',
            'VSAT Technician Service Point Palembang', 'VSAT Technician Service Point Palu', 'VSAT Technician Service Point Pekanbaru', 'VSAT Technician Service Point Pematangsiantar',
            'VSAT Technician Service Point Pontianak', 'VSAT Technician Service Point Purwokerto', 'VSAT Technician Service Point Samarinda', 'VSAT Technician Service Point Semarang',
            'VSAT Technician Service Point Solo', 'VSAT Technician Service Point Surabaya', 'VSAT Technician Service Point Tangerang', 'VSAT Technician Service Point Tangerang Kota',
            'VSAT Technician Service Point Tangerang Selatan', 'VSAT Technician Service Point Yogyakarta', 'Web Develop', 'Cost Controller', 'VSAT Technician Service Point Sorong',
            'Vice President', 'VSAT technician service point Mataram', 'VSAT technician service point Jakarta Utara', 'Service point Ambon'
        ];

        foreach ($name as $pos_name) {
            DB::table('tbl_position')->insert([
                'pos_name' => $pos_name
            ]);
        }
       
    }
}
