<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()
        ->orderBy('name')
        ->get();
        // $message = $request->session()->get('message');
        // return view('products.index', compact('products', 'message'));
        return $products;
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
        $category = Category::where('category', $request->category)->get('id');
        $subcategory = Subcategory::where('subcategory', $request->subcategory)->get('id');

        $products = Product::create([
            'name'=> $request->name,
            'gross_price'=> $request->gross_price,
            'discount'=> $request->discount,
            'amount' => $request->amount,
            'image_product'=> $request->fileNameToStore,
            'description' => $request->description,
            'color' => $request->color,
            'size' => $request->size,
            'flavor' => $request->flavor,
            'category_id'=> $category[0]->id,
            'subcategory_id'=> $subcategory[0]->id
        ]);
        return response()->json([
            'message' => 'Produto criado com Sucesso'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $product = Product::find($request->id);

        return response()->json([
            'product' => $product
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        if($request->name !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->name = $request->name;
            $updateProduct->save();
        }
        elseif($request->description !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->description = $request->description;
            $updateProduct->save();
        }
        elseif($request->gross_price !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->gross_price = $request->gross_price;
            $updateProduct->save();
        }
        elseif($request->discount !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->discount = $request->discount;
            $updateProduct->save();
        }
        elseif($request->amount !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->amount = $request->amount;
            $updateProduct->save();
        }
        elseif($request->color !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->color = $request->color;
            $updateProduct->save();
        }
        elseif($request->size !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->size = $request->size;
            $updateProduct->save();
        }
        elseif($request->flavor !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->flavor = $request->flavor;
            $updateProduct->save();
        }
        elseif($request->gross_price !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->gross_price = $request->gross_price;
            $updateProduct->save();
        }
        elseif($request->category !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->category = $request->category;
            $updateProduct->save();
        }
        elseif($request->subcategory !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->subcategory = $request->subcategory;
            $updateProduct->save();
        }
        elseif($request->fileNameToStore !== null){
            $updateProduct = Product::findOrFail($request->id);
            $updateProduct->fileNameToStore = $request->fileNameToStore;
            $updateProduct->save();
        }
        DB::commit();

        return response()->json([
            'message' => 'Produto alterado com Sucesso'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $productName = '';

        DB::transaction(function() use ($product, &$productName) {
            $productTemp = Product::findOrFail($product->id);
            $productName = $productTemp->name;
            Product::destroy($product->id);
        });

        return response()->json([
            'productName' => $product,
            'message' => 'Produto excluído com sucesso'
        ]);
    }
    //Custom functions
    public function saveImage(Request $request) {

        if($request->hasFile('image_product')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image_product')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image_product')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            // $path = $request->file('image_product')->storeAs('public/image_product', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }
        return response()->json([
            'fileNameToStore' => $fileNameToStore
        ], 201);
    }
}
