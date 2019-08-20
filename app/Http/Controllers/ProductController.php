<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query()
        ->orderBy('name')
        ->get();
        $message = $request->session()->get('message');

        return view('products.index', compact('products', 'message'));
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

        $products = Itens::create([
            'name'=> $request->name,
            'gross_price'=> $request->gross_price,
            'net_price'=> $request->net_price,
            'discount'=> $request->discount,
            'amount'=> $request->amount,
            'image_product'=> $fileNameToStore,
            'category'=> $category,
            'subcategory'=> $subcategory
        ]);
        $request->session()->flash(
            'mensagem',
            "Item {$products->id} criad@ com sucesso {$products->nome}"
        );
        // return redirect('/itens')->withInput(Request::only('nome'));
        return  redirect()->route('listar_itens');


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
