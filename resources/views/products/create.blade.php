@extends('admin.layout')

@section('admincontent')
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h1>Product Add:</h1>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            <label for="name">Name</label>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Product Image</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="product_image">
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" name="description" placeholder="Leave a description here" id="description" style="height: 100px"></textarea>
            <label for="description">Description</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="sid" id="sid" placeholder="Unique ID">
            <label for="sid">Unique ID</label>
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" id="brand" name="brand" aria-label="Brand example">
                <option selected>Select Brand here</option>
                <option value="Xiomi">Xiomi</option>
                <option value="Apple">Apple</option>
                <option value="Realme">Realme</option>
            </select>
            <label for="brand">Brand</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" name="price" id="price" placeholder="Price">
            <label for="price">Price</label>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    
@endsection