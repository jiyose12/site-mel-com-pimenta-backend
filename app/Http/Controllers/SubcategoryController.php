<?php

namespace App\Http\Controllers;

use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        $updateSubcategory = Subcategory::findOrFail($request->id);
        $updateSubcategory->subcategory = $request->subcategory;
        $updateSubcategory->save();
        DB::commit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategoryName = '';

        DB::transaction(function() use ($subcategory, &$subcategoryName) {
            $subcategoryTemp = Subcategory::find($subcategory->id);
            $subcategoryName = $subcategoryTemp->name;

            $subcategoryTemp->products->each(function (Product $product){
                $product->delete();
            });

            Subcategory::destroy($subcategory->id);
        });
        return response()->json([
            'subcategoryName' => $subcategoryName,
            'message' => 'Subcategoria excluída com sucesso'
        ]);
    }
}
