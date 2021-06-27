@extends('layouts.master')

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif
        <form class="mb-5" method="POST" action="{{route('product.update', $product['id'])}}" novalidate>
            @csrf
            <div class="row">
                <div class="col">
                    <label for="product-name">Product Name</label>
                    <input type="text"  @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product['name'] }}" class="form-control" id="product-name" placeholder="name">
                    @error('product_name')
                    <span class="invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col">
                    <div class="col">
                        <label for="quantity">Quantity in Stock</label>
                        <input type="text" @error('quantity') is-invalid @enderror" name="quantity" class="form-control" id="quantity" value="{{ $product['quantity'] }}" placeholder="quantity">
                        @error('quantity')
                        <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="price">Price per item</label>
                        <input type="number" @error('price') is-invalid @enderror" name="price" value="{{ $product['price'] }}"  class="form-control" id="price" placeholder="price">
                        @error('price')
                        <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" id="add-product">
                Update Product
            </button>
        </form>

        @include('product.table')
    </div>
@endsection
