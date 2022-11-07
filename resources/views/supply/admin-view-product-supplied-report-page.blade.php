@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">{{ __('View Product Supplied Report') }}</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('View products supplied report') }}
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

                <div class="card rounded-3 border border-light">
                    <div class="card-body">
                        @if ($productsSuppliedReport->count() > 0)
                            <form action="{{ route('admin.getSuppliedProductsReport') }}" method="get">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="start_date" class="mb-2">To:</label>
                                        <input type="date" name="start_date" id="start_date"
                                            class="form-control form-control-lg @error('start_date') is-invalid @enderror">
                                        @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">

                                        <label for="end_date" class="mb-2">end_date:</label>
                                        <input type="date" name="end_date" id="end_date"
                                            class=" form-control form-control-lg @error('end_date') is-invalid @enderror">
                                        @error('end_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="col-md-4">

                                        <div class="d-grid mx-auto mt-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Show</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="d-grid mx-auto mt-4">
                                        <button class="btn btn-primary btn-lg" id="productSuppliedReportPageBtn_pdf"
                                        onclick="generateProductSuppliedReportPDF()">
                                            <i data-fa-symbol="pdf" class="fa-regular fa-file-pdf fa-3x"></i><svg
                                                class="icon">
                                                <use xlink:href="#pdf"></use>
                                            </svg><strong class="font-big">{{ __('Print in PDF') }}</strong>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-grid mx-auto mt-4">
                                        <button class="btn btn-primary btn-lg" id="productSuppliedReportPageBtn_excel"
                                        onclick="generateProductSuppliedReportExcel()">
                                            <i data-fa-symbol="excel" class="fa-regular fa-file-excel fa-3x"></i><svg
                                                class="icon">
                                                <use xlink:href="#excel"></use>
                                            </svg><strong class="font-big">{{ __('Print in Excel') }}</strong>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('admin.suppliedProductsReport') }}" method="get">
                                    <div class="d-grid mx-auto mt-4">
                                        <button class="btn btn-primary btn-lg">
                                            <i data-fa-symbol="repeat_solid" class="fa-solid fa-repeat fa-3x"></i><svg
                                                class="icon">
                                                <use xlink:href="#repeat_solid"></use>
                                            </svg>
                                            <strong class="font-big">{{ __('Reload Data') }}</strong>
                                        </button>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="view_productsSuppliedReport_page" class="table table-bordered border rounded table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Company Name</th>
                                        <th>Brand</th>
                                        <th>Received Person</th>
                                        <th>Product Name</th>
                                        <th>Company Phone</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Supplied Receipt</th>
                                        <th>Supplied Address</th>
                                        <th>Total Amount</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productsSuppliedReport as $index => $productsSuppliedRpt)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>{{ ucwords(Auth::user()->name) }}</td>
                                        <td>{{ ucwords($productsSuppliedRpt->addProduct->product_name) }}</td>
                                        <td>{{ $productsSuppliedRpt->price }}</td>
                                        <td>{{ $productsSuppliedRpt->quantity}}</td>
                                        <td>{{ $productsSuppliedRpt->total_amount }}</td>
                                        <td>{{ $productsSuppliedRpt->created_at }}</td>
                                        <td>{{ $productsSuppliedRpt->updated_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        @include('layouts.utilities.general_modal')

                    </div>

                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        <script>
            new simpleDatatables.DataTable("#view_productsSuppliedReport_page", {})
        </script>
    @endpush
@endsection
