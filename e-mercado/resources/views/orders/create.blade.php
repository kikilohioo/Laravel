@extends('layouts.app')
@section('content')
    <h1>Order Detail</h1>
    <h3 class="text-center"><strong>sub-Total: $ {{ $cart->total }}</strong></h3>
    <div class="text-center mb-3">
        <form method="POST" action="{{ route('orders.store') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Finish Checkout</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->products as $product)
                    <tr>
                        <td>
                            <img height="60" src="{{ asset('images/'.$product->images->first()->path) }}"
                                alt="{{ $product->title }}">
                            {{ $product->title }}
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td><strong>$ {{ $product->total }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
