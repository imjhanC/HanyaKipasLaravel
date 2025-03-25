<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            [
                'company_id' => 101,
                'company_name' => 'Tech Innovators Inc.',
            ],
            [
                'company_id' => 102,
                'company_name' => 'Green Energy Solutions',
            ],
            [
                'company_id' => 103,
                'company_name' => 'NextGen Robotics Ltd.',
            ],
            [
                'company_id' => 104,
                'company_name' => 'Eco Friendly Tech Pvt. Ltd.',
            ],
            [
                'company_id' => 105,
                'company_name' => 'Global AI Systems',
            ],
        ]);
    }
}
