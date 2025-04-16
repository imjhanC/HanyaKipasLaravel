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
        // Define the base path for the product images
        $basePath = public_path('Products');

        DB::table('products')->insert([
            // Bladeless Fans
            [
                'product_id' => 1,
                'model' => 'BladeFree X1',
                'p_desc' => 'A sleek bladeless fan with advanced airflow technology.',
                'company_id' => 101,
                'p_category' => 'bladeless',
                'p_price' => 150.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/bladelessfan/bladeless1.jpg')),
            ],
            [
                'product_id' => 2,
                'model' => 'BladeFree X2',
                'p_desc' => 'A bladeless fan with remote control and oscillation.',
                'company_id' => 102,
                'p_category' => 'bladeless',
                'p_price' => 250.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/bladelessfan/bladeless2.jpg')),
            ],
            [
                'product_id' => 3,
                'model' => 'BladeFree Y1',
                'p_desc' => 'A compact bladeless fan for small spaces.',
                'company_id' => 103,
                'p_category' => 'bladeless',
                'p_price' => 350.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/bladelessfan/bladeless3.jpg')),
            ],
            [
                'product_id' => 4,
                'model' => 'BladeFree Y2',
                'p_desc' => 'A bladeless fan with smart home integration.',
                'company_id' => 104,
                'p_category' => 'bladeless',
                'p_price' => 450.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/bladelessfan/bladeless4.jpg')),
            ],
            [
                'product_id' => 5,
                'model' => 'BladeFree Z1',
                'p_desc' => 'A bladeless fan with ultra-quiet operation.',
                'company_id' => 105,
                'p_category' => 'bladeless',
                'p_price' => 550.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/bladelessfan/bladeless5.jpg')),
            ],

            // Ceiling Fans
            [
                'product_id' => 6,
                'model' => 'CeilingPro X1',
                'p_desc' => 'A high-performance ceiling fan with modern design.',
                'company_id' => 101,
                'p_category' => 'celling',
                'p_price' => 200.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/cellingfan/cellingfan1.jpg')),
            ],
            [
                'product_id' => 7,
                'model' => 'CeilingPro X2',
                'p_desc' => 'A ceiling fan with energy-efficient motor.',
                'company_id' => 102,
                'p_category' => 'celling',
                'p_price' => 300.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/cellingfan/cellingfan2.jpg')),
            ],
            [
                'product_id' => 8,
                'model' => 'CeilingPro Y1',
                'p_desc' => 'A durable ceiling fan for industrial use.',
                'company_id' => 103,
                'p_category' => 'celling',
                'p_price' => 400.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/cellingfan/cellingfan3.jpg')),
            ],
            [
                'product_id' => 9,
                'model' => 'CeilingPro Y2',
                'p_desc' => 'A stylish ceiling fan with remote control.',
                'company_id' => 104,
                'p_category' => 'celling',
                'p_price' => 500.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/cellingfan/cellingfan4.jpg')),
            ],
            [
                'product_id' => 10,
                'model' => 'CeilingPro Z1',
                'p_desc' => 'A ceiling fan with smart home integration.',
                'company_id' => 105,
                'p_category' => 'celling',
                'p_price' => 600.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/cellingfan/cellingfan5.jpg')),
            ],

            // Table Fans
            [
                'product_id' => 11,
                'model' => 'TableFan A1',
                'p_desc' => 'A table fan with adjustable height and speed.',
                'company_id' => 101,
                'p_category' => 'table',
                'p_price' => 250.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/tablefan/tablefan1.jpg')),
            ],
            [
                'product_id' => 12,
                'model' => 'TableFan A2',
                'p_desc' => 'A table fan with a built-in air purifier.',
                'company_id' => 102,
                'p_category' => 'table',
                'p_price' => 350.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/tablefan/tablefan2.jpg')),
            ],
            [
                'product_id' => 13,
                'model' => 'TableFan B1',
                'p_desc' => 'A portable table fan with USB charging.',
                'company_id' => 103,
                'p_category' => 'table',
                'p_price' => 450.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/tablefan/tablefan3.jpg')),
            ],
            [
                'product_id' => 14,
                'model' => 'TableFan B2',
                'p_desc' => 'A table fan with a modern and sleek design.',
                'company_id' => 104,
                'p_category' => 'table',
                'p_price' => 550.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/tablefan/tablefan4.jpg')),
            ],
            [
                'product_id' => 15,
                'model' => 'TableFan C1',
                'p_desc' => 'A table fan with ultra-quiet operation.',
                'company_id' => 105,
                'p_category' => 'table',
                'p_price' => 650.1,
                'p_img' => base64_encode(file_get_contents($basePath . '/tablefan/tablefan5.jpg')),
            ],
        ]);
    }
}