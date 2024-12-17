<?php

namespace App\Http\Controllers;

use App\Models\userextra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserextraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch the userextra data for the authenticated user
        $userextra = userextra::where('user_id', Auth::id())->first();
        
        // Debug to check if data is fetched correctly
        // dd($userextra); 
    
        // Pass the data to the view
        return view("home", ['userextra' => $userextra]);
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
                // Validate the request data
        $request->validate([
            'userprofile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get all request data
        $data = $request->all();

        // Process and move the uploaded image file
        if ($request->hasFile('userprofile')) {
            $imageName = time().'.'.$request->userprofile->getClientOriginalExtension(); 
            $request->userprofile->move(public_path('images/userprofile'), $imageName);
            $data['userprofile'] = $imageName; // Store the image name in the $data array
        }

        // Get the authenticated user's ID
        $userId = Auth::id();
        $data['user_id'] = $userId; // Add the user's ID to the data array

        // Debugging: Print the data array to ensure it includes the user ID and image name
        // dd($data);

        // Create a new userextra entry using the validated data
        userextra::create($data);

        // $request->session()->put('user_id', $userId);

         // Redirect back with success message
        return redirect()->route('userextra.index',['data'=>$data])->with('success', 'User information submitted successfully!');
        }
    
    public function home()
    {
        // dd($data);
        // $userExtra = UserExtra::where('user_id', Auth::id())->first();
        // dd($userExtra);
        //return view('home',['UserExtra'=>$userExtra]);
        // dd($userExtra);
    }
    /**
     * Display the specified resource.
     */
    public function show(userextra $userextra)
    {
        dd('hi');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(userextra $userextra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, userextra $userextra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(userextra $userextra)
    {
        //
    }
}
