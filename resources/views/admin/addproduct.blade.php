@extends('admin.layout')

@section('style')
    <style>
        .add-product-form-container {
            padding: 25px;
            margin-bottom: 25px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .add-product-form-container form {
            padding: 20px;
        }

        .add-product-form-container h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .form-floating .form-control,
        .form-floating .form-select {
            background-color: #fff;
            color: #333;
            border: 1px solid #ced4da;
        }

        .form-floating label {
            color: #666;
        }

        .form-floating .form-control:focus,
        .form-floating .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            color: #333;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 10px 25px;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
    </style>
@endsection

@section('admincontent')
<div class="content-wrapper">
    <div class="container add-product-form-container">
        <form action="{{ isset($isEdit) ? route('products.update', $product->id) : route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($isEdit))
                @method('PUT')
            @endif
            <h1>{{ isset($isEdit) ? 'Edit Product' : 'Add New Product' }}</h1>
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ isset($product) ? $product->name : '' }}">
                <label for="name">Product Name</label>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Product Image</label>
                <input type="file" class="form-control" id="inputGroupFile01" name="product_image">
                @if(isset($product) && $product->product_image)
                    <img src="{{ asset('images/'.$product->product_image) }}" alt="Current Product Image" style="max-width: 100px; margin-left: 10px;">
                @endif
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" name="description" placeholder="Leave a description here" id="description" style="height: 100px">{{ isset($product) ? $product->description : '' }}</textarea>
                <label for="description">Product Description</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="sid" id="sid" placeholder="Unique ID" value="{{ isset($product) ? $product->sid : '' }}">
                <label for="sid">Product ID</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="brand" name="brand" aria-label="Brand selection">
                    <option selected disabled>Select Brand</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}" {{ isset($product) && $product->brand == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <label for="brand">Brand</label>
            </div>

            <div class="form-floating mb-4">
                <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="{{ isset($product) ? $product->price : '' }}">
                <label for="price">Price</label>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{ isset($isEdit) ? 'Update Product' : 'Add Product' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
