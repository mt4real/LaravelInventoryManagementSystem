@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">{{ __('View Product Supplied') }}</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('view product supplied') }}
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


            <div class="card rounded-3 border border-light">
                <div class="card-body">
                    <form action="{{ route('admin.archiveSuppliedPrd') }}" method="POST">
                        @csrf
                        @if ($view_supplied_products->count()>0)
                        @canany(['archiveSuppliedProductAll','restoreArchivedProductSupplied'], App\Models\User::class);

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input suppliedProductCheck_all" type="checkbox" id="suppliedProductCheck_all"
                                        title="check to archive all the selected data">
                                    <label class="form-check-label" for="suppliedProductCheck_all">
                                        Select all
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-grid col-6">
                                    <a href="#" class="suppliedProduct_deleteAll btn btn-primary btn-lg" role="button">Delete
                                        all</a>
                                </div>
                            </div>

                        </div>
                        @endcanany
                        @endif
                        <div class="table-responsive">
                            <table id="view_supplied_products"
                                class="table table-bordered table-striped border rounded mt-3">

                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>#</th>
                                        <th>Supplied Company Name</th>
                                        <th>Brand</th>
                                        <th>Product Supplied</th>
                                        <th>Quantity Supplied</th>
                                        <th>Unit Price</th>
                                        <th>Total Amount</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_supplied_products as $index => $view_supplied_product)
                                        <tr tr_{{ $view_supplied_product->id }}>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input suppliedProductCheck_checkbox" type="checkbox"
                                                        id="supplied_ids" name="supplied_ids[]"
                                                        value="{{ $view_supplied_product->id }}"
                                                        data-id="{{ $view_supplied_product->id }}">
                                                    <label class="form-check-label" for="supplied checkbox">

                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ ucwords($view_supplied_product->company_supplied) }}</td>
                                            <td>{{ $view_supplied_product->brand}}</td>
                                            <td>{{ $view_supplied_product->product_supplied }}</td>
                                            <td>{{ $view_supplied_product->quantity_supplied }}</td>
                                            <td>{{ $view_supplied_product->unit_price }}</td>
                                            <td>{{ $view_supplied_product->total_amount_supplied }}</td>
                                            <td>{{ $view_supplied_product->created_at }}</td>
                                            <td>{{ $view_supplied_product->updated_at }}</td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="edit supplied product">
                                                    @canany(['editSuppliedProductCreate'], App\Models\User::class)
                                                    <a href="{{ URL::signedRoute('admin.editSuppliedProduct', ['id' => $view_supplied_product->id]) }}"
                                                        role="button" class="btn btn-primary delete-all"><i
                                                            class="fas fa-edit"></i>Edit</a>
                                                                @endcanany
                                                    <a href="#adminDeleteSuppliedProductModal{{ $view_supplied_product->id }}"
                                                        role="button" data-bs-toggle="modal" class="btn btn-danger single_delete"><i
                                                            class="fas fa-trash"></i>Delete</a>

                                                    <a href="#viewSuppliedProductModal{{ $view_supplied_product->id }}"
                                                        role="button" data-bs-toggle="modal" class="btn btn-primary"
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


            <!-- Archive multiple Supplied Product Modal -->

            <div class="modal fade" id="adminArchivedMultipleSuppliedProductModal" tabindex="-1"
                aria-labelledby="adminArchivedMultipleSuppliedProductModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to archive the selected Supplied product(s)?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-outline-danger">Archive</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>

            <!-- Archive Supplied Product Modal -->
            @foreach ($view_supplied_products as $view_supplied_product)
                <div class="modal fade" id="adminDeleteSuppliedProductModal{{ $view_supplied_product->id }}" tabindex="-1"
                    aria-labelledby="adminDeleteSuppliedProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this Supplied product?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <form
                                    action="{{ URL::signedRoute('admin.archiveSuppliedProduct', ['id' => $view_supplied_product->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" data-toggle="confirmation"
                                        class="btn btn-outline-danger">Archive</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



            <!-- View Supplied Product Modal -->
            @foreach ($view_supplied_products as $view_supplied_product)
                <div class="modal fade" id="viewSuppliedProductModal{{ $view_supplied_product->id }}" tabindex="-1"
                    aria-labelledby="viewSuppliedProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('View Supplied Product Details') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="h5"><strong>Supplied Product Company:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->company_supplied }}
                                </p>
                                <h5 class="h5"><strong>Receiver Name:</strong></h5>
                                <p class="text-justify">
                                    {{ ucwords(Auth::user()->name) }}
                                </p>
                                <h5 class="h5"><strong>Supplied Product Name:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->product_supplied }}
                                </p>
                                <h5 class="h5"><strong>Supplied Product Mobile:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->phone_supplied }}
                                </p>
                                <h5 class="h5"><strong>Quantity Product Supplied:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->quantity_supplied }}
                                </p>


                                <h5 class="h5"><strong>Unit Price:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->unit_price }}
                                </p>
                                <h5 class="h5"><strong>Supplied Rceceipt Number:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->supplied_receipt }}
                                </p>
                                <h5 class="h5"><strong>Total Amount of The Supplied Product:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->total_amount_supplied }}
                                </p>
                                <h5 class="h5"><strong>Supplied Product Address:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->address_supplied }}
                                </p>
                                <h5 class="h5"><strong>Date Created:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->created_at }}
                                </p>
                                <h5 class="h5"><strong>Date Updated:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_supplied_product->updated_at }}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </main>
    @push('scripts')
        <script>
            new simpleDatatables.DataTable("#view_supplied_products", {})
        </script>
    @endpush
@endsection
