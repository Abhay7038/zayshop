<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        $product = Products::all(); // Retrieve all products
        
        return view('admin.admin', compact('product'));
    }    
}
