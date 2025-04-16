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
        DB::table('products')->insert([
            [
                'product_id' => 1,
                'model' => 'Model X1',
                'p_desc' => 'A high-performance fan with advanced features.',
                'company_id' => 101,
                'p_category' => 'celling',
                'p_price' => 100.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 2,
                'model' => 'Model X2',
                'p_desc' => 'A compact and energy-efficient fan.',
                'company_id' => 102,
                'p_category' => 'celling',
                'p_price' => 200.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 3,
                'model' => 'Model Y1',
                'p_desc' => 'A durable fan designed for industrial use.',
                'company_id' => 103,
                'p_category' => 'celling',
                'p_price' => 300.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 4,
                'model' => 'Model Y2',
                'p_desc' => 'A stylish fan with remote control.',
                'company_id' => 104,
                'p_category' => 'celling',
                'p_price' => 400.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 5,
                'model' => 'Model Z1',
                'p_desc' => 'An ultra-quiet fan for bedrooms.',
                'company_id' => 105,
                'p_category' => 'celling',
                'p_price' => 500.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 6,
                'model' => 'Model Z2',
                'p_desc' => 'A fan with smart home integration.',
                'company_id' => 106,
                'p_category' => 'celling',
                'p_price' => 600.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 7,
                'model' => 'Model A1',
                'p_desc' => 'A fan with adjustable height and speed.',
                'company_id' => 107,
                'p_category' => 'standing',
                'p_price' => 700.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 8,
                'model' => 'Model A2',
                'p_desc' => 'A fan with a built-in air purifier.',
                'company_id' => 108,
                'p_category' => 'standing',
                'p_price' => 800.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 9,
                'model' => 'Model B1',
                'p_desc' => 'A fan with a modern and sleek design.',
                'company_id' => 109,
                'p_category' => 'desk',
                'p_price' => 900.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 10,
                'model' => 'Model B2',
                'p_desc' => 'A portable fan with USB charging.',
                'company_id' => 110,
                'p_category' => 'desk',
                'p_price' => 1000.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 11,
                'model' => 'Model C1',
                'p_desc' => 'A fan with a built-in humidifier.',
                'company_id' => 111,
                'p_category' => 'tower',
                'p_price' => 1100.1,
                'p_img' => $blobData,
            ],
            [
                'product_id' => 12,
                'model' => 'Model C2',
                'p_desc' => 'A fan with a 360-degree oscillation feature.',
                'company_id' => 112,
                'p_category' => 'tower',
                'p_price' => 1200.1,
                'p_img' => $blobData,
            ],
        ]);
    }
}