@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                        @include('layouts.utilities.user-daialog')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-5 primary-light-colour">
                        <strong class="font-small primary-second-colour">{{__('The quantity of the')}} {{$edit_product->product_name}}  {{__('is')}} {{$edit_product->product_quantity}} {{(__('and its current total amount is'))}} {{$edit_product->total_amount}}</strong>
                    </div>

                    <div class="col-8">
                        <div class="card  rounded-3  border border-light ">
                            <div class="card-header">
                                <h5 class="card-title">Product</h5>
                                <h6 class="card-subtitle text-muted">Edit below.</h6>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('admin.editProduct', ['id' => $edit_product->id]) }}" method="POST">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="category_id" class="mb-3">Product Catgeory</label>
                                            <select
                                                class="form-control form-control-lg mb-3 @error('category_id') is-invalid @enderror"
                                                id="category_id" name="category_id" placeholder="Supplied Company Name">
                                                <option disabled selected>Select category</option>
                                                @foreach ($edit_categories as $edit_category)
                                                    <option value="{{ $edit_category->id }}"
                                                        @if ($edit_product->category_id === $edit_category->id) selected @endif>
                                                        {{ $edit_category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="product_name" class="mb-3">Product Name</label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('product_name') is-invalid @enderror mb-3"
                                                id="product_name" name="product_name" placeholder="add product Name" value="{{$edit_product->product_name}}">
                                            @error('product_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="product_defect" class="mb-3">Defect Product</label>
                                            <input type="text" class="form-control form-control-lg mb-3" id="product_defect"
                                                name="product_defect" placeholder="Defect Product" value="{{$edit_product->product_defect}}">
                                            @error('product_defect')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="product_quantity" class="mb-3">Product Quantity</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3 @error('product_quantity') is-invalid @enderror"
                                                name="product_quantity" id="product_quantity"
                                                placeholder="Product Quantity" value="{{$edit_product->product_quantity}}">
                                            @error('product_quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                            <label for="sale_price" class="mb-3">Sale Unit Price</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3"
                                                name="sale_price" id="sale_price" placeholder="Sale Unit Price" value="{{$edit_product->sale_price}}" readonly>

                                        </div>

                                    </div>
                                    <div class="d-grid col-8 mx-auto mt-2">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg">{{ __('Edit Product') }}</button>
                                    </div>

                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
