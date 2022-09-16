<div class="card mb-3">
    <div id="carousel{{ $product->id }}" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach ($product->images as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img class="d-block w-100 card-img-top" src="{{ asset($image->path ?? '') }}" alt="{{ $product->title }}" height="300">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $product->id }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $product->id }}" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
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
