@extends('layouts.app')
@section('content')
	<h1>Create a Product</h1>
	<form method="POST" action="{{route('products.store')}}">
		@csrf
		<div class="form-row">
			<label>Title</label>
			<input class="form-control" type="text" value="{{old('title')}}" name="title" required>
		</div>
		<div class="form-row">
			<label>Description</label>
			<input class="form-control" type="text" value="{{old('description')}}" name="description" required>
		</div>
		<div class="form-row">
			<label>Price</label>
			<input class="form-control" type="number" min="1.00" step="0.01" value="{{old('price')}}" name="price" required>
		</div>
		<div class="form-row">
			<label>Stock</label>
			<input class="form-control" type="number" min="0" value="{{old('stock')}}" name="stock" required>
		</div>
		<div class="form-row">
			<label>Status</label>
			<select class="custom-select" name="status">
				<option {{old('status') == 'available' ? 'selected' : ''}} value="available">Available</option>
				<option {{old('status') == 'unavailable' ? 'selected' : ''}} value="unavailable">Unavailable</option>
			</select>
		</div>
		<div class="form-row">
			<button type="submit" class="btn btn-primary btn-lg">Create Product</button>
		</div>
	</form>
@endsection