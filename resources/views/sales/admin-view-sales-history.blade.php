@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">{{ __('View Sales History Report') }}</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('View sales history report ') }}
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
                        @if ($salesHistoryReport->count() > 0)
                            {{-- @canany(['archiveProductAll'], App\Models\User::class) --}}
                            <form action="{{ route('admin.getSalesHistoryReport') }}" method="get">

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
                                        <button class="btn btn-primary btn-lg">
                                            <i data-fa-symbol="pdf" class="fa-regular fa-file-pdf fa-3x"></i><svg
                                                class="icon">
                                                <use xlink:href="#pdf"></use>
                                            </svg><strong class="font-big">{{ __('Print in PDF') }}</strong>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-grid mx-auto mt-4">
                                        <button class="btn btn-primary btn-lg">
                                            <i data-fa-symbol="excel" class="fa-regular fa-file-excel fa-3x"></i><svg
                                                class="icon">
                                                <use xlink:href="#excel"></use>
                                            </svg><strong class="font-big">{{ __('Print in Excel') }}</strong>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- @endcanany --}}
                        @endif
                        <div class="table-responsive">
                            <table id="view_salesHistoryReport"
                                class="table table-bordered border rounded table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>#</th>
                                        <th>Sales Person</th>
                                        <th>Product Name</th>
                                        <th>Sales Quantity</th>
                                        <th>Quantity Remain</th>
                                        <th>Sales Price</th>
                                        <th>Total Amount</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salesHistoryReport as $index => $salesHistoryRpt)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input product_checkbox" type="checkbox"
                                                        id="product_ids" name="product_ids[]"
                                                        value="{{ $salesHistoryRpt->id }}" data-id="{{ $salesHistoryRpt->id }}">
                                                    <label class="form-check-label" for="supplied_check">
                                                    </label>

                                                </div>
                                            </td>
                                            <td>{{""}}</td>
                                            <td>{{ $salesHistoryRpt->product_name }}</td>
                                            <td>{{ $salesHistoryRpt->product_quantity }}</td>
                                            <td>{{ $salesHistoryRpt->sale_price }}</td>
                                            @if (empty($salesHistoryRpt->product_defect))
                                                <td>{{ 'Nill' }}</td>
                                            @else
                                                <td>{{ $salesHistoryRpt->product_defect }}</td>
                                            @endif
                                            <td>{{ $salesHistoryRpt->total_amount }}</td>
                                            <td>{{ $salesHistoryRpt->created_at }}</td>
                                            <td>{{ $salesHistoryRpt->updated_at }}</td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="product actions">
                                                    @canany(['updateExistingProductCreate', 'editProductCreate'],
                                                        App\Models\User::class)
                                                        <a href="{{ URL::signedRoute('admin.editProduct', ['id' => $salesHistoryRpt->id]) }}"
                                                            role="button" class="btn btn-primary"><i
                                                                class="fas fa-edit"></i>Edit</a>
                                                        <a href="{{ URL::signedRoute('admin.existingProduct', ['id' => $salesHistoryRpt->id]) }}"
                                                            role="button" class="btn btn-primary"
                                                            title="Update the quntity of the existing product">
                                                            <i class="fa-solid fa-pen-to-square"></i>Update</a>
                                                    @endcanany
                                                    <a href="#adminDeleteProductModal{{ $salesHistoryRpt->id }}"
                                                        role="button" data-bs-toggle="modal" class="btn btn-danger"><i
                                                            class="fas fa-trash"></i>Delete</a>
                                                    <a href="#viewProductModal{{ $salesHistoryRpt->id }}" role="button"
                                                        data-bs-toggle="modal" class="btn btn-primary"
                                                        class="btn btn-primary"><i class="fas fa-eye"></i>View</a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        @include('layouts.utilities.general_modal')

                    </div>

                </div>
            </div>
            {{--
<!-- Archive multiple Product Modal -->

<div class="modal fade" id="adminArchiveMultipleProductModal" tabindex="-1"
aria-labelledby="adminArchiveMultipleProductModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Message</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close"></button>
</div>
<div class="modal-body">
Are you sure you want to archive these selected product(s)?
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline-primary"
data-bs-dismiss="modal">Cancel</button>

<button type="submit" class="btn btn-outline-danger">Archive</button>

</div>
</div>
</div>
</div>
</form>

<!-- Delete Product Modal -->
@foreach ($salesHistoryReport as $salesHistoryRpt)
<div class="modal fade" id="adminDeleteProductModal{{ $salesHistoryRpt->id }}" tabindex="-1"
aria-labelledby="adminDeleteProductModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Message</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close"></button>
</div>
<div class="modal-body">
Are you sure you want to archive this product?
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline-primary"
data-bs-dismiss="modal">Cancel</button>
<form action="{{ URL::signedRoute('admin.archivedProduct', ['id' => $salesHistoryRpt->id]) }}"
method="post">
@csrf
<button type="submit" class="btn btn-outline-danger">Archive</button>
</form>
</div>
</div>
</div>
</div>
@endforeach



<!-- View Sales Report Modal -->
@foreach ($salesHistoryReport as $salesHistoryRpt)
<div class="modal fade" id="viewProductModal{{ $salesHistoryRpt->id }}" tabindex="-1"
aria-labelledby="viewProductModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">{{ __('View Supplied Product Details') }}
</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close"></button>
</div>
<div class="modal-body">
<h5 class="h5"><strong>Entered By:</strong></h5>
<p class="text-justify">
{{ ucwords(Auth::user()->name) }}
</p>
<h5 class="h5"><strong>Product Category:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->category->category_name}}
</p>

<h5 class="h5"><strong>Product Name:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->product_name }}
</p>

<h5 class="h5"><strong>Quantity Product Supplied:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->product_quantity }}
</p>
<h5 class="h5"><strong>Sale Price:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->sale_price }}
</p>
<h5 class="h5"><strong>Defect Product:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->product_defect }}
</p>
<h5 class="h5"><strong>Total Amount of The Product:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->total_amount }}
</p>
<h5 class="h5"><strong>Product Status:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->product_status }}
</p>
<h5 class="h5"><strong>Date Created:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->created_at }}
</p>
<h5 class="h5"><strong>Date Updated:</strong></h5>
<p class="text-justify">
{{ $salesHistoryRpt->updated_at }}
</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline-primary"
data-bs-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
@endforeach --}}
        </div>
    </main>
    @push('scripts')
        <script>
            new simpleDatatables.DataTable("#view_salesHistoryReport", {})
        </script>
    @endpush
@endsection
