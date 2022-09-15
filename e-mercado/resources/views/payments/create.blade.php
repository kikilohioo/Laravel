@extends('layouts.app')
@section('content')
    <h1>Payment Detail</h1>
    <h3 class="text-center"><strong>sub-Total: $ {{ $order->total }}</strong></h3>
    <div class="text-center mb-3">
        <form method="POST" action="{{ route('orders.payments.store', [
            'order' => $order->id
        ]) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Pay</button>
        </form>
    </div>
@endsection
