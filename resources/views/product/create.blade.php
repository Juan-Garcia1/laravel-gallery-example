@extends('layouts.app')

@section('css')
    <style>
        #label-container {
            height: 140px;
            background: #ebebeb;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    <ul class="nav mb-3">
        <li class="nav-item">
        <a class="nav-link btn btn-primary" href="{{ route('product.index') }}">Go back</a>
        </li>
    </ul>
    <h2 class="mb-5">Add a product</h2>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-9">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value={{ old('name') }}>
            @error('name')
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
          </div>
          <div class="form-group col-md-3">
            <label for="price">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value={{ old('price') }}>
            @error('price')
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="product-image">Product Image</label>
            <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/jpeg" id="product-image">
            @error('image')
                <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div id="product-image-container" class="mb-3"></div>

        <div class="form-group mt-5">
            <label id="label-container" class="d-flex align-items-center" for="gallery" style="cursor: pointer;">Click here to upload images</label>
            <input type="file" class="form-control-file" name="gallery[]" accept="image/jpeg" id="gallery" multiple style="display: none;">
        </div>
        <div class="mb-4 row" id="gallery-container">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
      </form>
@endsection

@section('javascript')
    <script>
        const productImgInput = document.querySelector('#product-image');
        const productImgContainer = document.querySelector('#product-image-container');

        const galleryInput = document.querySelector('#gallery');
        const galleryContainer = document.querySelector('#gallery-container');

        productImgInput.addEventListener('change', function() {
            let reader = new FileReader();
    
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.setAttribute('src', e.target.result);
                img.style.width = "25%";
                
                productImgContainer.append(img);
            };
            reader.readAsDataURL(this.files[0]);
        });

        galleryInput.addEventListener('change', function(e) {
            const countFiles = this.files.length;

            for(var i = 0; i < countFiles; i++) {
                const img = document.createElement('img');
                const reader = new FileReader();
                reader.onload = function (e) {
                    img.setAttribute('src', e.target.result)
                    img.classList.add('img-fluid', 'col-md-3');
                    galleryContainer.append(img);
                    
                }
                reader.readAsDataURL(this.files[i]);
            }
        
            
            // var reader = new FileReader();

            // reader.onload = function (e) {
                // console.log(e.target.result);
                
                // get loaded data and render thumbnail.
                // document.getElementById("img-preview").src = e.target.result;
            // };

            // reader.readAsDataURL(this.files[0]);

        });
    </script>
@endsection