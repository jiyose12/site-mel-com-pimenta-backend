<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            [
                'subcategory' => 'Sutiãs',
                'category_id' => '1'

            ],
            [
                'subcategory' => 'Calcinhas básicas',
                'category_id' => '1'

            ],
            [
                'subcategory' => 'Calcinhas fio dental',
                'category_id' => '1'

            ],
            [
                'subcategory' => 'Conjunto lingerie',
                'category_id' => '1'

            ],
            [
                'subcategory' => 'Camisolas',
                'category_id' => '1'

            ],
            [
                'subcategory' => 'Baby doll',
                'category_id' => '1'

            ],
            [
                'subcategory' => 'Pomadas',
                'category_id' => '2'

            ],
            [
                'subcategory' => 'Comestíveis',
                'category_id' => '2'

            ],
            [
                'subcategory' => 'Brincadeiras eróticas',
                'category_id' => '2'

            ],
            [
                'subcategory' => 'Lubrificantes',
                'category_id' => '2'

            ]

        ]);
    }
}
