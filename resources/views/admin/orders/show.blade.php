@extends('admin.layout')

@section('admincontent')
<div class="container py-4">
    <h1 class="h2 mb-4">Order Details</h1>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h2 class="h4 mb-3">Order Information</h2>
                    <p><strong>Order ID:</strong> {{ $order->orderid }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</p>
                    <p>
                        <strong>Status:</strong>
                        <span class="badge
                            @if($order->order_status == 'Completed') bg-success
                            @elseif($order->order_status == 'Processing') bg-primary  
                            @elseif($order->order_status == 'Cancelled') bg-danger
                            @else bg-warning
                            @endif">
                            {{ $order->order_status }}
                        </span>
                    </p>
                    <p><strong>Total Amount:</strong> ₹{{ number_format($order->price, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <h2 class="h4 mb-3">Customer Information</h2>
                    <p><strong>Name:</strong> {{ $order->username }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="h4 mb-3">Update Status</h2>
                <form action="{{ route('orders.update', $order) }}" method="POST" class="d-flex align-items-center gap-2">
                    @csrf
                    @method('PUT')
                    <select name="order_status" class="form-select w-auto">
                        <option value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Completed" {{ $order->order_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
