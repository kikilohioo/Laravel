@extends('layouts.app')
@section('content')
    <h1>Payment Detail</h1>
    {{isset($preference) ? $preference->id : ''}}
    <h3 class="text-center"><strong>sub-Total: $ {{ $order->total }}</strong></h3>
    <div class="text-center mb-3">
        <form method="POST" action="{{ route('orders.payments.store', [
            'order' => $order->id,
        ]) }}"
            class="d-inline">
            @csrf
            {{-- Pago Comun --}}
            <button type="submit" class="btn btn-success">Pay</button>
        </form>
        {{-- Mercado Pago Checkout Pro --}}
        <div class="cho-container mt-2"></div>
        {{-- PayPal Checkout --}}
        <form action="{{route('paypal.pay')}}" method="post">
            @csrf
            <input type="hidden" name="amount" value="{{$order->total}}">
            <button class="mt-2 btn btn-primary" type="submit">
                Pay with 
                <i class="ms-2 fa-2xl fa-brands fa-cc-paypal"></i>
            </button>
        </form>
        {{-- dlocal payments --}}
        <form action="{{route('dlocal.pay')}}" method="post">
            @csrf
            <input type="hidden" name="amount" value="{{$order->total}}">
            <input type="hidden" name="order_id" value="{{$order->id}}">
            <button class="mt-2 btn btn-primary" type="submit">
                Pay with 
                <strong>d-local</strong>
            </button>
        </form>
    </div>
    {{-- Mercado Pago Checkout Pro --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const cart_id = urlParams.get('cart')
        const mp = new MercadoPago('{{config('services.mercadopago.key')}}', {
            locale: 'es-AR'
        });

        mp.checkout({
            preference: {
            id: cart_id
            },
            render: {
            container: '.cho-container',
            label: 'Pay with Mercado Pago',
            }
        });
    </script>
@endsection
