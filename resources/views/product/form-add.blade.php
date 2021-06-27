@extends('layouts.master')

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="bg-grey col-md-6 offset-3 mb-5">
            <h3 class="mb-3 text-center">Enter product details</h3>
            <form class="mb-5" method="POST" novalidate>
                @csrf
                    <div class="form-group">
                        <label for="product-name">Product Name</label>
                        <input type="text"  @error('product_name') is-invalid @enderror" name="product_name"  value="{{ old('product_name') }}" class="form-control" id="product_name" placeholder="name">
                        @error('product_name')
                        <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity in Stock</label>
                        <input type="text" @error('quantity') is-invalid @enderror" name="quantity" class="form-control" id="quantity" value="{{ old('quantity') }}" placeholder="quantity">
                        @error('quantity')
                        <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price per item</label>
                        <input type="number" @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  class="form-control" id="price" placeholder="price">
                        @error('price')
                        <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                <button type="submit" id="submit" value="value" class="btn btn-primary" id="add-product">
                    Add Product
                </button>
            </form>
        </div>

        @include('product.table')
    </div>
@endsection
