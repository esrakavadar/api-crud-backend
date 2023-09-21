<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $product = product::all();
        return $product;
    }
  
  
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'product_code' => 'required',
        ]);

        $product = new Product();
        $product->title = $validatedData['title'];
        $product->price = $validatedData['price'];
        $product->product_code = $validatedData['product_code'];
        $product->description = $validatedData['description'];


        $product->save();

        return response()->json(['message' => 'Ürün başarıyla oluşturuldu'], 201);
    }

  

    public function show(string $id)
    {
        $product = Product::find($id);
        return response()->json($product);
        // // Veritabanından veriyi al
        // $product = Product::find($id);

        // // Ürün bulunamadıysa
        // if (!$product) {
        //     return response()->json(['message' => 'Ürün bulunamadı'], 404);
        // }

        // // Ürünü JSON yanıtında döndür
        // return response()->json(['data' => $product]);
    }

  
  
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'product_code' => 'required',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Ürün bulunamadı'], 404);
        }

        // Verileri güncelle
        $product->title = $validatedData['title'];
        $product->price = $validatedData['price'];
        $product->product_code = $validatedData['product_code'];
        $product->description = $validatedData['description'];

        // Kaynağı güncelle
        $product->save();

        return response()->json(['message' => 'Ürün başarıyla güncellendi']);
    }

  
    public function delete(string $id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Ürün bulunamadı'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Ürün başarıyla silindi']);
}

}
