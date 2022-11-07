@extends('layouts.backend.backend_design')
@section('content')
<main class="content">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                @include('layouts.utilities.user-daialog')
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-5 primary-light-colour">
                <strong class="font-small primary-second-colour">{{__('The current sales price of')}} {{$edit_price->product_name}}  {{__('is')}} {{$edit_price->sale_price}} {{(__('and the its quantity is'))}} {{$edit_price->product_quantity}} {{__('.')}}{{__('The total amount of this product in stock is now')}} {{$edit_price->total_amount}}</strong>
            </div>
        <div class="row">
            <div class="col-8">
                <div class="card  rounded-3  border border-light ">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Product') }}</h5>
                        <h6 class="card-subtitle text-muted">{{ __('Change Product Price below.') }}</h6>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('admin.changePrice', ['id' => $edit_price->id])}}" method="POST">
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
                                                @if ($edit_price->category_id === $edit_category->id) selected @endif>
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
                                        id="product_name" name="product_name" placeholder="add product Name" value="{{$edit_price->product_name}}">
                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            <div class="row ">
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <label for="sale_price" class="mb-3">Product sales price</label>
                                    <input type="text" class="form-control form-control-lg mb-3 @error('sale_price') is-invalid @enderror" id="sale_price"
                                        name="sale_price" placeholder="Update Sales Price" value="">
                                    @error('sale_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="d-grid col-8 mx-auto mt-2">
                                <button type="submit" class="btn btn-primary btn-lg">Update Price</button>
                            </div>
                    </div>

                </div>

                </form>
            </div>
        </div>
    </div>
</main>

@endsection
