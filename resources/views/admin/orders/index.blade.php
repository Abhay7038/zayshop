@extends('admin.layout')

@section('admincontent')
<div class="container py-4">
    <h1 class="h2 mb-4">Orders</h1>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Description</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->orderid }}</td>
                                <td>{{ $order->username }}</td>
                                <td class="text-break">{{ $order->description }}</td>
                                <td>₹{{ number_format($order->price, 2) }}</td>
                                <td>
                                    <span class="badge
                                        @if($order->order_status == 'Completed') bg-success
                                        @elseif($order->order_status == 'Processing') bg-primary
                                        @elseif($order->order_status == 'Cancelled') bg-danger
                                        @else bg-warning
                                        @endif
                                    ">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
