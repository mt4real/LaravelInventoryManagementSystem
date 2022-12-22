@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">{{ __('Sales POS') }}</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('sales pos ') }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 colxs-12 mt-5">
                    @include('layouts.utilities.user-daialog')
                </div>
            </div>
            <div class="container-fluid mt-5">
                @include('layouts.utilities.general_modal')
                <div class="card rounded-3 border border-light">
                    <div class="card-body">

                        <form id="salesPOS" method="POST">
                            @csrf
                            <div class="row ">


                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="product_id" class="mb-3">Choose product name</label>
                                    <select class="form-control form-control-lg mb-3" id="product_id" name="product_id"
                                        data-ajax-input="product_id">
                                        <option disabled selected>Select product</option>
                                        @foreach ($product_names as $product_name)
                                            <option value="{{ $product_name->id }}">{{ $product_name->product_name }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                    <label for="product_quantity" class="mb-3">Product Quantity</label>
                                    <input type="text" class="form-control form-control-lg mb-3" name="product_quantity"
                                        id="product_quantity" placeholder="Product Quantity"
                                        data-ajax-input="product_quantity">
                                    <span class="invalid-feedback" role="alert"
                                        data-ajax-feedback="product_quantity"></span>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                    <label for="sale_price" class="mb-3">Sale Unit Price</label>
                                    <input type="text" class="form-control form-control-lg mb-3" name="sale_price"
                                        id="sale_price" placeholder="Sale Unit Price" data-ajax-input="sale_price">
                                    <span class="invalid-feedback" role="alert" data-ajax-feedback="sale_price"></span>
                                </div>

                            </div>

                            <div class="d-grid col-8 mx-auto mt-2">
                                <button type="submit" id="add_product" class="btn btn-primary btn-lg">{{ __('Add Product') }}</button>
                            </div>
                        </form>
                        <hr>

                        <div class="table-responsive">
                            <table id="view_sales" class="table table-bordered border rounded table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Product Name</th>
                                        <th>Sale Price</th>
                                        <th>Product Quantity</th>
                                        <th>Sub Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="salesPOSDataBody">
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end" id="main_total">
                                <span class="font-big">
                                    <strong class="primary-second-colour">{{ __('Total:') }}
                                        &nbsp;&nbsp;&nbsp; <span id="total_sales"></span></strong>

                                </span>
                            </div>
                            <hr>
                            <div class="d-grid mx-auto col-6 mt-3">
                                <button type="button" id="make_sales_btn" class="btn btn-primary p-3" data-bs-toggle="modal"
                                    data-bs-target="#paymentModal" style="display: none;">Make sales payment</button>
                            </div>
                        </div>
                    </div>

                    <!-- Payment modal -->
                    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="PaymentModalLabel"
                        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="modal-body">
                                    <div class="bg-success rounded text-white p-3">
                                        <span class="font-big" aria-labelledby="total payment">
                                            <strong>{{ __('Total:') }}&nbsp;&nbsp;</strong>
                                            <span id="payment_total"></span>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="mt-3 d-grid col-12">
                                            <button type="button" class="btn btn-primary">
                                                <i data-fa-symbol="print" class="fa-solid fa-print fa-3x"></i><svg
                                                    class="icon">
                                                    <use xlink:href="#print"></use>
                                                </svg><strong class="font-big">{{ __('Print') }}</strong>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="payment_form mt-3">
                                        <form  method="POST" id="salesPayment">
                                            @csrf
                                            <div class="row">
                                                <div class="bg-secondary-light p-3 col-12">
                                                    <label for="customer_name" class="p-2">Customer Name</label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        name="customer_name" id="customer_name"
                                                        placeholder="Customer Name" data-ajax-input="customer_name"
                                                    <span class="invalid-feedback" role="alert"
                                                        data-ajax-feedback="customer_name"></span>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <p aria-labelledby="payment_type" class="p-2">Payment method</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="payment_type" id="cash"  value="Cash"
                                                            data-ajax-input="payment_type">
                                                        <label class="form-check-label" for="cash">
                                                            <i data-fa-symbol="wallet" class="fa-solid fa-wallet"></i><svg
                                                                class="icon">
                                                                <use xlink:href="#wallet"></use>
                                                            </svg> Cash
                                                        </label>
                                                    </div>

                                                </div>

                                                <div class="col-4">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="payment_type" id="transfer" value="Transfer"
                                                            data-ajax-input="payment_type">
                                                        <label class="form-check-label" for="transfer">
                                                            <i data-fa-symbol="credit_card_alt"
                                                                class="fa-solid fa-credit-card-alt"></i><svg
                                                                class="icon">
                                                                <use xlink:href="#credit_card_alt"></use>
                                                            </svg> Transfer
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="col-4">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="payment_type" id="POS" value="POS"
                                                            data-ajax-input="payment_type">
                                                        <label class="form-check-label" for="POS">
                                                            <i data-fa-symbol="credit_card_blank"
                                                                class="fa-solid fa-credit-card-blank"></i><svg
                                                                class="icon">
                                                                <use xlink:href="#credit_card_blank"></use>
                                                            </svg> POS
                                                        </label>
                                                    </div>

                                                </div>
                                                <span class="invalid-feedback" role="alert"
                                                    data-ajax-feedback="payment_type"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label for="paid_amount" class="p-2">Money received from
                                                        customer</label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        name="paid_amount" id="paid_amount"
                                                        placeholder="Money received from customer"
                                                        data-ajax-input="paid_amount">
                                                    <span class="invalid-feedback" role="alert"
                                                        data-ajax-feedback="paid_amount"></span>
                                                    <p class="text-danger" role="alert" id="invalid_amount"></p>
                                                </div>
                                                <div class="col-12">
                                                    <p class="font-big bg-success rounded text-white p-3"
                                                        aria-labelledby="customer change">
                                                        <strong>{{ __('Customer Change:') }}&nbsp;&nbsp;</strong>
                                                        <span id="customer_change"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-grid col-6 mx-auto mt-3">
                                                <button type="submit" class="btn btn-primary rounded"
                                                    id="make_payment">Make payment</button>
                                                    <p class="mt-3 text-center" id="double_payment">

                                                    </p>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="d-flex justify-content-end p-2">
                                        <button class="btn btn-primary"  id="btn_next" data-bs-target="#printReceiptModal" data-bs-toggle="modal" data-bs-dismiss="modal">next</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
             <!--end of payment modal-->

             <!--start of printing receipt modal-->
                    <div class="modal fade" id="printReceiptModal"
                    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="printReceiptModalLabel" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="printReceiptModalLabel">Print Receipt</h5>
                                </div>
                                <div class="modal-body text-center" id="receipt_modalBodyData">
                                    <img src="./logo.png" alt="Company Logo">
                                    <p class="company_name" class="centered">

                                    </p>
                                    <span>Customer name:</span><p id="customerName" class="centered">

                                    </p>
                                   <div class="d-flex justify-content-center">

                                    <table>
                                        <thead>
                                            <tr class="p-4">
                                                <th>S/N</th>
                                                <th  class="productName">Product Name</th>
                                                <th class="quantity">QTY</th>
                                                <th class="price">Price</th>
                                                <th class="amount">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="salesReceiptBody">
                                            <tr class="p-4">
                                                <td id="serial_no" class="serial_no"></td>
                                                <td id="prd_name" class="productName prd_name"></td>
                                                <td id="qty" class="quantity qty"></td>
                                                <td id="pr" class="price pr"></td>
                                                <td id="sub_total" class="amount sub_total"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                   </div>

                                    <div class="d-flex justify-content-end mt-5">
                                      <span>Grand Total:</span>
                                        <p id="overAll_total">

                                        </p>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-end">
                                        <span>Change:</span>
                                        <p id="balance_collect">

                                        </p>
                                    </div>
                                    <hr>
                                    <p class="centered">Thanks for your purchase!
                                        <br> from <span class="company_name"></span>
                                    </p>
                                </div>
                                <div class="modal-footer">

                                    <button type="submit"  class="btn btn-primary" id="printReceipt">Print Receipt</button>

                                    <button class="btn btn-primary" data-bs-target="#paymentModal" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </main>
@endsection
