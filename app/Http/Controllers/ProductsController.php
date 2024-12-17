<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = DB::table('products')->get();
        return view('admin.admin',['product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sid' => 'required',
            'brand' => 'required', 
            'price' => 'required|numeric'
        ]);

        $data = $request->all();
        
        // Process and move the uploaded image file
        if ($request->hasFile('product_image')) {
            $imageName = time().'.'.$request->product_image->getClientOriginalExtension(); 
            $request->product_image->move(public_path('images'), $imageName);
            $data['product_image'] = $imageName;
        }
        
        Products::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(products $product)
    {
        return view('admin.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $product)
    {
        $categories = Category::all();
        // Pass isEdit flag to differentiate between create and edit forms
        return view('admin.addproduct', compact('product', 'categories'))->with('isEdit', true);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sid' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric'
        ]);

        $data = $request->all();

        if ($request->hasFile('product_image')) {
            // Delete old image
            if ($product->product_image && file_exists(public_path('images/' . $product->product_image))) {
                unlink(public_path('images/' . $product->product_image));
            }
            
            // Upload new image
            $imageName = time().'.'.$request->product_image->getClientOriginalExtension();
            $request->product_image->move(public_path('images'), $imageName);
            $data['product_image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(products $product)
    {
        // Delete the product image if it exists
        if ($product->product_image && file_exists(public_path('images/' . $product->product_image))) {
            unlink(public_path('images/' . $product->product_image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
