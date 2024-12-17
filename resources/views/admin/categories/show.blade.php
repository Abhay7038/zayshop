@extends('admin.layout')

@section('admincontent')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category Details</h4>

                    <div class="form-group">
                        <label class="font-weight-bold">Name:</label>
                        <p>{{ $category->name }}</p>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Slug:</label>
                        <p>{{ $category->slug }}</p>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Description:</label>
                        <p>{{ $category->description ?? 'No description available' }}</p>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Parent Category:</label>
                        <p>{{ $category->parent ? $category->parent->name : 'None' }}</p>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Status:</label>
                        <p>
                            <span class="badge {{ $category->status ? 'badge-success' : 'badge-danger' }}">
                                {{ $category->status ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary me-2">Edit</a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
