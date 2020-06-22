@extends('layouts.app')

@section('content')
    <ul class="nav mb-3">
        <li class="nav-item">
        <a class="nav-link btn btn-primary" href="{{ route('product.index') }}">Go back</a>
        </li>
    </ul>
    <h1>${{ number_format($product->price) }} - {{ $product->name }}</h1>
    <img src="{{ asset('storage/uploads/'.$product->image) }}" alt="">
    <p>{{ $product->description }}</p>

    {{-- if there images for the gallery, display them --}}
    @if (count($gallery) > 0)
        <div class="row mt-5">
            @foreach ($gallery as $galleryImg)
                <div class="col-md-3">
                    <img style="width:100%;" src="{{ asset('storage/uploads/gallery/'.str_replace('"', '', $galleryImg->image)) }}" alt="">
                </div>
            @endforeach
        </div>
    @endif
@endsection