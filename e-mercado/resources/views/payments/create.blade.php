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
            <button type="submit" class="btn btn-success">Pay</button>
        </form>
        <div class="cho-container"></div>
    </div>
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
            label: 'Pagar',
            }
        });
    </script>
@endsection
