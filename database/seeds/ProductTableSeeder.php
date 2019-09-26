<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Algemas Pretas',
                'gross_price' => 50,
                'discount' => 5,
                'amount' => 10,
                'description' => 'Algemas grandes de cor preta para todas as ocasiões',
                'color' => 'preto',
                'image_product' => 'noimage.png',
                'category_id' => 2,
                'subcategory_id' => 9
            ],
            [
                'name' => 'Calcinha da Vovó',
                'gross_price' => 25,
                'discount' => 50,
                'amount' => 660,
                'description' => 'Calcinha extremamente grande',
                'color' => 'rosa',
                'size' => '50',
                'image_product' => 'noimage.png',
                'category_id' => 1,
                'subcategory_id' => 1
            ]
        ]);
    }
}
