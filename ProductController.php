<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Проверяем, что category_id существует в таблице categories
            'photo' => 'nullable|image',
            'description' => 'required',
            'short_description' => 'required',
            'keywords' => 'required',
            'seo_title' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        // Обработка загрузки файла
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $product->photo = $path;
        }

        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->keywords = $request->keywords;
        $product->seo_title = $request->seo_title;
        $product->save();

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image',
            'description' => 'required',
            'short_description' => 'required',
            'keywords' => 'required',
            'seo_title' => 'required',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        // Обработка обновления файла
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $product->photo = $path;
        }

        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->keywords = $request->keywords;
        $product->seo_title = $request->seo_title;
        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}