@extends('layouts.app')

@section('content')
    <ul class="nav justify-content-end">
        <li class="nav-item">
        <a class="nav-link btn btn-primary" href="{{ route('product.create') }}">Add Product</a>
        </li>
    </ul>
    <div class="row">
        @forelse ($products as $product)
        <div class="col-md-3">
            <a href="{{ route('product.show', $product->id) }}">
                <img class="img-fluid" src="{{ asset('storage/uploads/'.$product->image) }}" alt="{{ $product->name }}">
                <h4>{{ $product->name }}</h4>
            </a>
        </div>
        @empty
            <p>There are no prodducts currently</p>
        @endforelse
    </div>
@endsection