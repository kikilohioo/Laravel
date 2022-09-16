@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Admin Panel</div>
            <div class="card-body">
                <div class="list-group">
                    <a class="list-group-item" href="{{route('products.index')}}">
                        Manage Products
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
