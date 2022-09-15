<div class="card mb-3">
    <img src="{{ asset($product->images->first()->path ?? '') }}" alt="{{ $product->title }}" height="300">
    <div class="card-body">
        <h3 class="text-right"><strong>$ {{ $product->price }}</strong></h3>
        <h4 class="card-title">{{ $product->title }}</h4>
        <p class="card-text">{{ $product->title }}</p>
        <p class="card-text"><strong>{{ $product->stock }} left</strong></p>
        @if(isset($cart))
            <p class="card-text">{{$product->pivot->quantity}}<strong>(${{$product->total}})</strong></p>
            <form method="POST"
                action="{{ route('products.carts.destroy', [
                    'product' => $product->id,
                    'cart' => $cart->id,
                ]) }}"
                class="d-inline">
                @csrf
				@method('DELETE')
                <button type="submit" class="btn btn-danger">Remove from Cart</button>
            </form>
        @else
            <form method="POST"
                action="{{ route('products.carts.store', [
                    'product' => $product->id,
                ]) }}"
                class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>
        @endif
    </div>
</div>
