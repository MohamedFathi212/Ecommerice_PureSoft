<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/subcategories'), $imageName);
        }

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory created successfully!');
    }

    public function show($id)
    {
        $subcategory = SubCategory::with('category')->findOrFail($id);
        return view('admin.subcategories.show', compact('subcategory'));
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = $subcategory->image;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/subcategories'), $imageName);
        }

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory updated successfully!');
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        if ($subcategory->image && file_exists(public_path('images/subcategories/' . $subcategory->image))) {
            unlink(public_path('images/subcategories/' . $subcategory->image));
        }
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory deleted successfully!');
    }
}
