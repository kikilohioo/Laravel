@extends('layouts.app')
@section('content')
	<h1>{{ $product->title }} (#{{ $product->id }})</h1>
	<h3>Price: $ {{ $product->price }}</h3>
	<p>Description: {{ $product->description }}</p>
	<p>Status: {{ $product->status }}</p>
	<p>Stock: {{ $product->stock }}</p>
@endsection