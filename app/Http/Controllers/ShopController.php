<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Session; // Import the Session facade
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    protected $totalQuantity;

    public function __construct()
    {
        // Retrieve the cart items for the current user
        $cartItems = Cart::get();

        // Count the number of cart items
        $this->totalQuantity = $cartItems->sum('qty');

        // Share totalQuantity with all views
        view()->share('totalQuantity', $this->totalQuantity);
    }

    public function index()
    {
        $products = Products::orderBy('id', 'desc')->take(3)->get();
        return view('shop.index', compact('products'));
    }

    public function show($id)
    {
        $product = Products::find($id); // Assuming you have a Product model

        return view('shop.shop-single', compact('product'));
    }

    public function all(Request $request)
    {
        $query = Products::query();

        // Check if a brand filter is applied
        if ($request->has('brand') && !empty($request->brand)) {
            $query->where('brand', $request->brand);
        }

        // Get unique brands for categories
        $categories = Products::select('brand')->distinct()->get();

        // Fetch the filtered or all products
        $products = $query->get();

        // Pass the products, categories and selected brand back to the view
        return view('shop.shop', [
            'products' => $products,
            'categories' => $categories,
            'selectedBrand' => $request->brand, // Optional: for UI selection
        ]);
    }

    // public function filterBrands(Request $request)
    // {
    //     $filter = $request->input('filter');

    //     // Fetch filtered brands from the database
    //     $brands = Brand::where('category', $filter)->get();

    //     $view = view('partials.brands', compact('brands'))->render();

    //     return response()->json(['html' => $view]);
    // }


}