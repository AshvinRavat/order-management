@extends('layout.main')

@section('title')
    Order List
@endsection

@section('content')
    <div class="container col-5 mt-5">
        @include('layout.message')
    </div>
    <div class="container col-6 border p-4 mt-5">
        <a href="{{ route('order.create') }}" class="d-inline  btn btn-primary">Add Order</a>
        @if(count($orders) > 0)
        <h3 class="text-center">Orders</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Customer</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Total Orders</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->grand_total }}</td> 
                            <td>{{ $order->products_count }}</td> 
                            <td>
                                 <form action="{{ route('order.delete', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <div>
            <p class="text-center">No Orders</p>
        </div>
        @endif
    </div>
@endsection
