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
                    <div class="col-8">
                        <div class="card  rounded-3  border border-light ">
                            <div class="card-header">
                                <h5 class="card-title">Product</h5>
                                <h6 class="card-subtitle text-muted">Edit supplied product below.</h6>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('admin.editSuppliedProduct', ['id' => $edit_supplied_product->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="company_supplied" class="mb-3">Supplied Company Name</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3 @error('company_supplied') is-invalid @enderror"
                                                id="company_supplied" name="company_supplied"
                                                placeholder="Supplied Company Name"
                                                value="{{ $edit_supplied_product->company_supplied }}">
                                            <span class="invalid-feedback" role="alert">
                                                @error('company_supplied')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="brand" class="mb-3">Brand</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3 @error('brand') is-invalid @enderror"
                                                id="brand" name="brand"
                                                placeholder="Brand"
                                                value="{{$edit_supplied_product->brand}}">
                                            <span class="invalid-feedback" role="alert">
                                                @error('brand')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="product_supplied" class="mb-3">Supplied Product Name</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3 @error('product_supplied') is-invalid @enderror"
                                                id="product_supplied" name="product_supplied"
                                                placeholder="Supplied Product Name"
                                                value="{{ $edit_supplied_product->product_supplied }}">
                                            <span class="invalid-feedback" role="alert">
                                                @error('product_supplied')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="phone_supplied" class="mb-3">Phone Supplied</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3 @error('phone_supplied') is-invalid @enderror"
                                                id="phone_supplied" name="phone_supplied"
                                                placeholder="Supplied Mobile Number"
                                                value="{{ $edit_supplied_product->phone_supplied }}">
                                            <span class="invalid-feedback" role="alert">
                                                @error('phone_supplied')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="quantity" class="mb-3">Quantity Supplied</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3 @error('quantity_supplied') is-invalid @enderror"
                                                name="quantity_supplied" id="quantity_supplied"
                                                placeholder="Quantity Supplied"
                                                value="{{ $edit_supplied_product->quantity_supplied }}">
                                            <span class="invalid-feedback" role="alert">
                                                @error('quantity_supplied')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="unit_price" class="mb-3">Unit Price</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3"
                                                name="unit_price" id="unit_price" placeholder="Unit Price"
                                                value="{{ $edit_supplied_product->unit_price }}">

                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                            <label for="supplied_receipt" class="mb-3">Supplied Rceipt Number</label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-3"
                                                name="supplied_receipt" id="supplied_receipt" placeholder="Supplied Rceipt Number"
                                                value="{{ $edit_supplied_product->supplied_receipt}}">

                                        </div>

                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                            <label for="address_supplied"class="mb-3">Supplied Address</label>
                                            <textarea class="form-control form-control-lg mb-3 @error('address_supplied') is-invalid @enderror"
                                                name="address_supplied" id="address_supplied" placeholder="Supplied Address">{{ $edit_supplied_product->address_supplied }}</textarea>
                                            <span class="invalid-feedback" role="alert">
                                                @error('address_supplied')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>
                                        </div>

                                    </div>
                                    <div class="d-grid col-8 mx-auto mt-2">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg">{{ __('Edit Product Supplied') }}</button>
                                    </div>
                            </div>

                        </div>

                        </form>
                    </div>

            </div>
        </div>
    </main>
@endsection
