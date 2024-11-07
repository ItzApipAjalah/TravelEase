<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Categories::all();

        return view('categories.index', compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name_category' => 'required',
            'description' => 'nullable',
        ]);

        Categories::create($request->all());

        return redirect()->route('categories')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Categories $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name_category' => 'required',
            'description' => 'nullable',
        ]);

        $category->update($request->all());

        return redirect()->route('categories')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('categories')
            ->with('success', 'Category deleted successfully.');
    }
}
