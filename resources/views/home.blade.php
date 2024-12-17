@extends('layouts.app')

@section('style')
<style>
    /* Add this to your custom CSS file */
    .btn-primary:hover {
        background-color: #0056b3; /* Darker blue for hover */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow effect on hover */
        transform: scale(1.05); /* Slightly enlarges the button */
        transition: all 0.3s ease; /* Smooth transition */
    }

</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">{{ __('Dashboard2') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.admin') }}" class="btn btn-primary btn-lg px-4 py-2 shadow-sm hover-shadow-lg rounded-pill">
                            Go to Admin Dashboard
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    User-ID1 : {{ Auth::user()->id }} <br>
                    User-name : {{ Auth::user()->name }} <br>
                    E-mail : {{ Auth::user()->email }}   
                </div>
                <div class="card-body">
                    @if (isset($userextra))
                    <h4>User Additional Information :</h4>
                        <p>Profile Pic: <img src="{{ asset('images/userprofile/' .$userextra->userprofile) }}" alt="User Profile Image" style="width: 100px; height: 100px;"></p>
                        <p>Mobile Number: {{ $userextra->mobile }}</p>
                        <p>Address: {{ $userextra->address }}</p>
                        <p>Pin Code: {{ $userextra->pincode }}</p>
                        <p>Occupation: {{ $userextra->occupation }}</p>
                    @else
                        <form action="{{ route('userextra.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="userprofile">User Profile Image</label>
                                <input type="file" class="form-control" id="userprofile" name="userprofile" required>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required>
                                <label for="mobile">Mobile Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="address" placeholder="Leave an address here" id="address" style="height: 100px" required></textarea>
                                <label for="address">Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode" required>
                                <label for="pincode">Pin Code</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Enter occupation" required>
                                <label for="occupation">Occupation</label>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    @endif
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
