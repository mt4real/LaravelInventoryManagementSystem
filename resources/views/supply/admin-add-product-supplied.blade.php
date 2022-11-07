

 @extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">

                @include('layouts.utilities.custom_alert')
            </div>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Supplied product</h1><a class="badge bg-primary ms-2"
                    href="{{route('admin.addSuppliedProduct')}}" role="button">add supplied product<i
                        class="fas fa-fw fa-external-link-alt"></i></a>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Supplied product</h5>
                            <h6 class="card-subtitle text-muted">Add supplied product below.</h6>
                        </div>
                        <div class="card-body">

                            <form id="adminProductSupplied" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="company_supplied" class="mb-3">Supplied Company Name</label>
                                        <input type="text" class="form-control form-control-lg mb-3"
                                            id="company_supplied" name="company_supplied"
                                            placeholder="Supplied Company Name" data-ajax-input="company_supplied">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="company_supplied"></span>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="brand" class="mb-3">Brand</label>
                                        <input type="text" class="form-control form-control-lg mb-3"
                                            id="brand" name="brand"
                                            placeholder="Brand" data-ajax-input="brand">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="brand"></span>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="product_supplied" class="mb-3">Supplied Product Name</label>
                                        <input type="text" class="form-control form-control-lg mb-3"
                                            id="product_supplied" name="product_supplied"
                                            placeholder="Supplied Product Name" data-ajax-input="product_supplied">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="product_supplied"></span>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="phone_supplied" class="mb-3">Phone Supplied</label>
                                        <input type="text" class="form-control form-control-lg mb-3"
                                            id="phone_supplied" name="phone_supplied"
                                            placeholder="Supplied Mobile Number" data-ajax-input="phone_supplied">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="phone_supplied"></span>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="quantity_supplied" class="mb-3">Quantity Supplied</label>
                                        <input type="text" class="form-control form-control-lg mb-3"
                                            name="quantity_supplied" id="quantity_supplied"
                                            placeholder="Quantity Supplied" data-ajax-input="quantity_supplied">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="quantity_supplied"></span>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                        <label for="unit_price" class="mb-3">Unit Price</label>
                                        <input type="text" class="form-control form-control-lg mb-3"
                                            name="unit_price" id="unit_price" placeholder="Unit Price"
                                            data-ajax-input="unit_price">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="unit_price"></span>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="supplied_receipt" class="mb-3">Supplied Receipt Number</label>
                                        <input type="text" class="form-control form-control-lg mb-3"
                                            name="supplied_receipt" id="supplied_receipt" placeholder="Supplied Receipt Number"
                                            data-ajax-input="supplied_receipt">
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="supplied_receipt"></span>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="address_supplied"class="mb-3">Supplied Address</label>
                                        <textarea class="form-control form-control-lg mb-3" name="address_supplied" id="address_supplied"
                                            placeholder="Supplied Address" data-ajax-input="address_supplied"></textarea>
                                        <span class="invalid-feedback" role="alert"
                                            data-ajax-feedback="address_supplied"></span>
                                    </div>

                                </div>
                                <div class="d-grid col-8 mx-auto mt-2">
                                    <button type="submit" class="btn btn-primary btn-lg">Add Gas Supplied</button>
                                </div>
                        </div>

                    </div>

                    </form>
                        </div>
                    </div>
                </div>

    </main>
@endsection

