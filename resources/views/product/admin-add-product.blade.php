@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">

                @include('layouts.utilities.custom_alert')
            </div>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Product</h1><a class="badge bg-primary ms-2"
                    href="{{ route('admin.addProduct') }}" role="button">add product<i
                        class="fas fa-fw fa-external-link-alt"></i></a>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Product</h5>
                            <h6 class="card-subtitle text-muted">Add product below.</h6>
                        </div>
                        <div class="card-body">
                            <form id="adminAddProduct" method="POST">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="category_id" class="mb-3">Product Catgeory</label>
                                        <select class="form-control form-control-lg mb-3" id="category_id"
                                            name="category_id" placeholder="Supplied Company Name"
                                            data-ajax-input="category_id">
                                            <option disabled selected>Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="category_id"></span>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="product_name" class="mb-3">Product Name</label>
                                        <input type="text" class="form-control form-control-lg mb-3" id="product_name"
                                            name="product_name" placeholder="add product Name"
                                            data-ajax-input="product_name">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="product_name"></span>
                                    </div>
                                    <div class=" col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="product_defect" class="mb-3">Defect Product</label>
                                        <input type="text" class="form-control form-control-lg mb-3" id="product_defect"
                                            name="product_defect" placeholder="Defect Product" data-ajax-input="product_defect">
                                        <span class="invalid-feedback" role="alert" data-ajax-feedback="product_defect"></span>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="product_quantity" class="mb-3">Product Quantity</label>
                                        <input type="text" class="form-control form-control-lg mb-3"
                                            name="product_quantity" id="product_quantity" placeholder="Product Quantity"
                                            data-ajax-input="product_quantity">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="product_quantity"></span>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="sale_price" class="mb-3">Sale Unit Price</label>
                                        <input type="text" class="form-control form-control-lg mb-3" name="sale_price"
                                            id="sale_price" placeholder="Sale Unit Price" data-ajax-input="sale_price">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="sale_price"></span>
                                    </div>

                                </div>

                                <div class="d-grid col-8 mx-auto mt-2">
                                    <button type="submit" class="btn btn-primary btn-lg">{{ __('Add Product') }}</button>
                                </div>

                        </div>                        </div>

                    </div>
                </div>
            </div>
    </main>
@endsection
