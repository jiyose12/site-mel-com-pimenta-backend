<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

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
            $path = $request->file('image_product')->storeAs('public/image_product', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }
        $category = Category::where('category', $request->category)->get('id');
        $subcategory = Subcategory::where('subcategory', $request->subcategory)->get('id');

        $products = Product::create([
            'name'=> $request->name,
            'gross_price'=> $request->gross_price,
            'discount'=> $request->discount,
            'amount' => $request->amount,
            'image_product'=> $fileNameToStore,
            'description' => $request->description,
            'color' => $request->color,
            'size' => $request->size,
            'flavor' => $request->flavor,
            'category_id'=> $category[0]->id,
            'subcategory_id'=> $subcategory[0]->id
        ]);
        // $request->session()->flash(
        //     'message',
        //     "Item {$products->id} criad@ com sucesso {$products->nome}"
        // );
        // return redirect('/itens')->withInput(Request::only('nome'));
        // return  redirect()->route('listar_itens');
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
    public function show(Product $product)
    {
        //
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
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
