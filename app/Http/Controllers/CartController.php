<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\orders;
use Illuminate\Support\Facades\Auth;
use App\Models\products;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = cart::all();
        // dd($data);
        return view("shop.cart", ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shop.cart');
    }

    /**
     * Store a newly created resource in storage.
     */
     
     public function store(Request $request)
     {
         // Validate the request data
         $request->validate([
             'product_id' => 'required|exists:products,id',
         ]);
     
         // Retrieve the product ID from the request
         $productId = $request->input('product_id');
     
         // Find the product by ID
         $product = Products::find($productId);
     
         // Check if the product was found
         if (!$product) {
             return response()->json(['error' => 'Product not found.'], 404);
         }
     
         // Assuming 'sid' is a unique identifier for cart items
         $sid = $product->sid; // Make sure 'sid' is an attribute of your product model
     
         // Find or create the cart item by 'sid'
         $cartItem = Cart::firstOrNew(['sid' => $sid]);
     
         // Check if the cart item already exists
         if ($cartItem->exists) {
             // Increment the quantity if the product is already in the cart
             $cartItem->qty += 1;
         } else {
             // Set the attributes for the new cart item
             $cartItem->product_id = $product->id;  // Set the product_id
             $cartItem->name = $product->name;
             $cartItem->description = $product->description;
             $cartItem->brand = $product->brand;
             $cartItem->product_image = $product->product_image;
             $cartItem->price = $product->price;
             $cartItem->qty = 1;  // Default quantity is set to 1
         }
     
         // Save the cart item
         $cartItem->save();
     
         // Calculate the total quantity of items in the cart
         $totalQuantity = Cart::sum('qty');
     
         // Return JSON response with updated cart count
         return response()->json(['cartItemCount' => $totalQuantity]);
     }
     
     
    

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        // return view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // // dd('hi');
        // // $data = Cart::findOrFail($id);
        // // $increment = $request->increment;

        // // // Here you would handle the logic to update the quantity in the cart
        // // $currentQuantity = $data->quantity;
        
        // // if ($increment === 'true') {
        // //     // Increment the quantity
        // //     $newQuantity = $currentQuantity + 1;
        // // } else {
        // //     // Decrement the quantity, ensure it's not less than 1
        // //     $newQuantity = max(1, $currentQuantity - 1);
        // // }

        // // // Update the quantity in your cart
        // // $data->quantity = $newQuantity;
        // // $data->save();
        
        // // Redirect back to the edit view or wherever you want
        // return redirect()->route('cart.index', ['data' => $data->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function saveOrder(Request $request)
    {
        $items = Cart::all();
        $totalprice = 0;
        $description = '';
        $counter = 1;

        foreach ($items as $item) {
            $price = $item['price'] * $item['qty'];
            $totalprice += $price;
            $description .= "($counter). {$item['name']} * {$item['qty']}\n";
            $counter++;
        }

        $orders = [
            'orderid' => date('Ymdhs') . '-' . Auth::user()->id,
            'userid' => Auth::user()->id,
            'username' => Auth::user()->name,
            'description' => $description,
            'price' => $totalprice,
            'ordered_at' => date('Y-m-d H:i:s'),
            'order_status' => 'Processing',
        ];

        Orders::create($orders);
        Cart::truncate();

        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        $items = Cart::all();
        $counter = 1;
        $description = '';
        $totalprice = 0;
        $paypalItems = [];

        // Create PayPal Items
        foreach ($items as $item) {
            $name = $item['name'];
            $qty = $item['qty'];
            $price = $item['price'] * $qty; // Calculate price for each item
            $totalprice += $price; // Accumulate total price

            // Concatenate description (optional, may not be required for PayPal)
            $description .= "($counter). $name * $qty\n";
            $counter++;

            // Add each item to PayPal items
            $paypalItems[] = [
                'name' => $name,
                'quantity' => $qty,
                'unit_amount' => [
                    'currency_code' => 'USD',
                    'value' => number_format($item['price'], 2, '.', ''),  // Format the price to 2 decimals
                ],
            ];
        }

        // Format total price to ensure two decimal places
        $formattedTotalPrice = number_format($totalprice, 2, '.', '');  // This ensures $totalprice has 2 decimals

        // PayPal Order Data
        $orderData = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',  // Use USD for testing
                        'value' => $formattedTotalPrice,  // Use the formatted total price
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => 'USD',
                                'value' => $formattedTotalPrice,  // Ensure item total has 2 decimals
                            ],
                        ],
                    ],
                    'items' => $paypalItems,
                ],
            ],
        ];
        
        // Setup PayPal Client
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        
        // Get PayPal token
        $token = $paypal->getAccessToken();
        if (!$token) {
            return redirect()->route('cart.index')->with('error', 'Unable to authenticate with PayPal. Please try again.');
        }
        
        $paypal->setAccessToken($token);
        
        // Create PayPal Order
        $response = $paypal->createOrder($orderData);
        
        // Debug the PayPal response for errors
        Log::info('PayPal createOrder response:', $response);

        if (isset($response['id'])) {
            // Save order details in session for later use
            session(['order_details' => [
                'total_price' => $totalprice,
                'description' => $description
            ]]);
            
            // Redirect user to PayPal to complete payment
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            // Log error if order creation fails
            Log::error('PayPal order creation failed', ['response' => $response]);
            return redirect()->route('cart.index')->with('error', 'Something went wrong with the PayPal transaction.');
        }
    }

    public function capturePayment(Request $request)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $token = $paypal->getAccessToken();
        $paypal->setAccessToken($token);

        // Capture the order
        $response = $paypal->capturePaymentOrder($request->query('token'));

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Get order details from session
            $orderDetails = session('order_details');
            
            if ($orderDetails) {
                $this->saveOrder($orderDetails['total_price'], $orderDetails['description']);
                session()->forget('order_details');
                return redirect()->route('shop.index')->with('success', 'Payment successful and order placed!');
            }
            
            return redirect()->route('cart.index')->with('error', 'Order details not found.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Payment failed, please try again.');
        }
    }

    public function about(){
        return view('shop.about');
    }

    public function contact(){
        return view('shop.contact');
    }

}
