<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'id'); // Default sort by name
        $sortOrder = $request->input('sort_order', 'asc'); // Default sort order ascending

        $allowedSorts = ['id', 'created_at'];

        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id'; // fallback
        }

        // $newSortOrder = $sortOrder === 'asc' ? 'desc' : 'asc'; // Toggle sort order
        $products = Product::orderBy($sortBy, $sortOrder)->get();
        // $products = Product::get();
        return view('products.index', compact('products', 'sortBy', 'sortOrder'));
    }
    public function create(Request $request)
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Product::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'image' => $request->image ? $request->image->store('images', 'public') : null,
        ]);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
        
    }
    public function show(Request $request, $id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'detail' => $request->detail,
            'image' => $request->image ? $request->image->store('images', 'public') : $product->image,
        ]);
        // if ($request->hasFile('image')) {
        //     dd($request->file('image')->getMimeType());
        // }

        
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    public function destroy(Request $request, $id)
    {
        $product = Product::find($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
