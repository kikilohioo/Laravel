@extends('layouts.app')
@section('content')
	<h1>Edit a Product</h1>
	<form 
		method="POST" 
		action="{{route('products.update', ['product' => $product->id])}}"
		enctype="multipart/form-data"
	>
		@csrf
		@method('PUT')
		<div class="form-row">
			<label>Title</label>
			<input class="form-control" type="text" value="{{old('title') ?? $product->title}}" name="title" required>
		</div>
		<div class="form-row">
			<label>Description</label>
			<input class="form-control" type="text" value="{{old('description') ?? $product->description}}" name="description" required>
		</div>
		<div class="form-row">
			<label>Price</label>
			<input class="form-control" type="number" value="{{old('titpricele') ?? $product->price}}" min="1.00" step="0.01" name="price" required>
		</div>
		<div class="form-row">
			<label>Stock</label>
			<input class="form-control" type="number" value="{{old('stock') ?? $product->stock}}" min="0" name="stock" required>
		</div>
		<div class="form-row my-3">
			<label>Status</label>
			<select class="custom-select" name="status">
				<option {{old('status') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '') }} value="available">Available</option>
				<option {{old('status') == 'available' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '') }} value="unavailable">Unavailable</option>
			</select>
		</div>
		<div class="form-row mb-3">
            <label for="product-images" class="col-form-label">{{ __('Images') }}</label>

            <div class="col-6">
                <div class="custom-file">
                    <input id="product-images" accept="images/*" class="form-control" type="file" class="form-control"
                        name="images[]" multiple required>
                </div>
            </div>
        </div>
		<div class="form-row">
			<button type="submit" class="btn btn-primary btn-lg">Edit Product</button>
		</div>
	</form>
@endsection