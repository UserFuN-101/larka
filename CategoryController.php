<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image', // Изменил на nullable, чтобы можно было не загружать фото
            'description' => 'required',
            'short_description' => 'required',
            'keywords' => 'required',
            'seo_title' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;

        // Обработка загрузки файла
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public'); // Сохраняем файл в storage/app/public/photos
            $category->photo = $path; // Сохраняем путь к файлу в базе данных
        }

        $category->description = $request->description;
        $category->short_description = $request->short_description;
        $category->keywords = $request->keywords;
        $category->seo_title = $request->seo_title;
        $category->save();

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image', // Изменил на nullable
            'description' => 'required',
            'short_description' => 'required',
            'keywords' => 'required',
            'seo_title' => 'required',
        ]);

        $category->name = $request->name;

        // Обработка обновления файла
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $category->photo = $path;
        }

        $category->description = $request->description;
        $category->short_description = $request->short_description;
        $category->keywords = $request->keywords;
        $category->seo_title = $request->seo_title;
        $category->save();

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}