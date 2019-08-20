<?php

namespace App\Services;

use App\Product;
use Illuminate\Support\Facades\DB;

class StoreProducts
{
    public function createProduct(Request $request): Serie {
        DB::beginTransaction();
        $product = Product::create(
            ['nome' => $nomeSerie]
        );
        $this->createSubcategory($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();

        return $product;
    }

}
