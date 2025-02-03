<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $userRole = Auth::user()->role;

        if ($userRole === 'admin') {
            return view('admin.product.products', compact('products'));
        } elseif ($userRole === 'user') {
            return view('user.product.index', compact('products'));
        }

        // Optionally handle other roles or default case
        return redirect()->route('forbidden');
    }

    public function create()
    {
        return view('admin.product.create-product');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Simpan produk baru
            $product = new Product($request->only(['name', 'description', 'price', 'stock']));

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('products', 'public');
                $product->image = $path;
            }

            $product->save();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create product: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $product->update($request->only(['name', 'description', 'price', 'stock']));
            
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('products', 'public');
                $product->image = $path;
                $product->save();
            }

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update product: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
