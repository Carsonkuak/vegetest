<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create()
    {
        return view('add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mass' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'mass' => $request->mass,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('create')->with('success', 'Product added successfully!');
    }
    // public function getProducts() {
    //     $products = Product::select('name', 'mass', 'price')->get();

    //     return view('products.index', compact('products'));
    // }
    public function getProductsList() {
        $products = Product::all(); // Fetch all products from the database
        return response()->json($products); // Return the products in JSON format
    }

    public function show($id) {
        $product = Product::findOrFail($id); // Fetch the product based on its ID

        return view('show', compact('product')); // Return the show page with product details
    }


}
