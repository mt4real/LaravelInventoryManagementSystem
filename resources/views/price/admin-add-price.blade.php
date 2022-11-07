@extends('layouts.backend.backend_design')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h1 class="page-title font-big">Add Gas Price</h1>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Gas Price
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-8">
                <div class="card  rounded-3  border border-light ">
                    <div class="card-title bg-white mt-3">
                        <h2 class=" h2 d-flex justify-content-center">Add Gas Price</h2>
                    </div>
                    <div class="card-body">

                        <form id="adminGasPrice" method="POST">
                            @csrf
                            <div class="row ">
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <label for="gas_price" class="mb-3">Gas Price</label>
                                    <input type="text" class="form-control form-control-lg mb-3" id="gas_price"
                                        name="gas_price" placeholder="Company Name" data-ajax-input="gas_price">
                                    <span class="invalid-feedback" role="alert" data-ajax-feedback="gas_price"></span>
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
@endsection
