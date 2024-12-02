<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of the categories.
    public function index()
    {
        $categories = Category::paginate(25);
        return view('admin.section.category.index', compact('categories'));
    }

    // Show the form for creating a new category.
    public function create()
    {
        $categories = Category::latest()->take(5);
        return view('admin.section.category.create', compact('categories'));
    }

    // Store a newly created category in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'status' => 'boolean',
        ]);

        Category::create([
            'name' => strtolower($request->name),
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    // Show the form for editing the specified category.
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        if ($category) {
            return view('admin.section.category.edit', compact('category'));
        }

        return redirect()->route('admin.categories.index')->with('error', 'Category not found.');
    }


    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            $category->status = !$category->status;
            $category->save();
            return back()->with("success", "Status changed successfully");
        }

        return redirect()->route('admin.categories.index')->with('error', 'Category not found.');
    }

    // Update the specified category in storage.
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($category) {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
                'status' => 'boolean',
            ]);

            $category->update($request->all());

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
        }

        return redirect()->route('admin.categories.index')->with('error', 'Category not found.');
    }

    // Remove the specified category from storage.
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category) {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
        }

        return redirect()->route('admin.categories.index')->with('error', 'Category not found.');
    }
}
