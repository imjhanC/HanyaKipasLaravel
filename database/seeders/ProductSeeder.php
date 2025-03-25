<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagePath = public_path('fan_image.png');
        $blobData = base64_encode(file_get_contents($imagePath));
        DB::table('product')->insert([
            [
                'product_id' => 1,
                'model' => 'Model X1',
                'p_desc' => 'A high-performance fan with advanced features.',
                'company_id' => 101,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 2,
                'model' => 'Model X2',
                'p_desc' => 'A compact and energy-efficient fan.',
                'company_id' => 102,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 3,
                'model' => 'Model Y1',
                'p_desc' => 'A durable fan designed for industrial use.',
                'company_id' => 103,
                'p_img' => $blobData,
            ],
        ]);
    }
}
