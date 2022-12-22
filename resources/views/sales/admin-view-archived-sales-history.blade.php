@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">{{ __('View Archived Supplied Product(s)') }}</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('archived supplied product(s)') }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 colxs-12 mt-5">
                        @include('layouts.utilities.user-daialog')
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 colxs-12 mt-5">
                        @include('layouts.utilities.custom_alert')
                    </div>
                </div>
            </div>


            <div class="card rounded-3 border border-light">
                <div class="card-body">
                    @if($archived_suppliedProducts->count()>0)
                    @canany(['restoreSuppliedProductAll','deleteSuppliedProductPermanentlyAll'], App\Models\User::class)
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" id="suppliedArchiveProductCheck_all"
                                    title="check to delete all the selected data">
                                <label class="form-check-label" for="check_all">
                                    Select all
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="d-grid gap-2">
                                <button class="suppliedArchiveProduct_deleteAll btn btn-primary btn-lg">Delete
                                    all</button>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="d-grid gap-2">
                                <button
                                    class="suppliedArchiveProduct_restoreAll btn btn-primary btn-lg">Restore
                                    all</button>
                            </div>

                        </div>

                    </div>
                    @endcanany
                    @endif
                    <div class="table-responsive">
                        <table id="view_archived_supplied_products" class="table table-bordered table-striped border rounded mt-3">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>#</th>
                                    <th>Supplied Company Name</th>
                                    <th>Product Supplied</th>
                                    <th>Quantity Supplied</th>
                                    <th>Unit Price</th>
                                    <th>Total Amount</th>
                                    <th>Deleted By</th>
                                    <th>Date Deleted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($archived_suppliedProducts->count())
                                @foreach ($archived_suppliedProducts as $index => $archived_suppliedProduct)
                                    <tr tr_{{ $archived_suppliedProduct->id }}>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input suppliedArchiveProductCheck_checkbox" type="checkbox"
                                                    data-id="{{$archived_suppliedProduct->id }}">
                                                <label class="form-check-label" for="supplied_ids">
                                                </label>

                                            </div>
                                        </td>
                                        <td>{{ ucwords($archived_suppliedProduct->company_supplied) }}</td>
                                        <td>{{ $archived_suppliedProduct->product_supplied }}</td>
                                        <td>{{ $archived_suppliedProduct->quantity_supplied }}</td>
                                        <td>{{ $archived_suppliedProduct->unit_price }}</td>
                                        <td>{{ $archived_suppliedProduct->total_amount_supplied }}</td>
                                        <td>{{ $archived_suppliedProduct->user->name }}</td>
                                        <td>{{ $archived_suppliedProduct->deleted_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="edit supplied product">
                                                <a href="#adminDeleteSuppliedProductModal{{ $archived_suppliedProduct->id }}"
                                                    role="button" data-bs-toggle="modal" class="btn btn-danger"><i
                                                        class="fas fa-trash"
                                                        title="Delete supplied product permanently"></i>Delete</a>
                                                <a href="#viewSuppliedProductModal{{ $archived_suppliedProduct->id }}"
                                                    role="button" data-bs-toggle="modal" class="btn btn-primary"
                                                    class="btn btn-primary"><i class="fas fa-eye"></i>View</a>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>

                    @include('layouts.utilities.general_modal')

                </div>

            </div>

                <!-- Restore multiple Supplied Product Modal -->

                <div class="modal fade" id="adminRestoreMultipleSuppliedProductModal" tabindex="-1"
                    aria-labelledby="adminRestoreMultipleSuppliedProductModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               Restore The Selected Supplied Products
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Cancel</button>

                                <button type="submit" name="supplied_restore" class="btn btn-outline-primary">Restore</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete multiple Supplied Product Modal -->

                <div class="modal fade" id="adminDeleteMultipleSuppliedProductModal" tabindex="-1"
                    aria-labelledby="adminDeleteMultipleSuppliedProductModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the selected Supplied
                                product(s) permanently?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Cancel</button>

                                <button type="submit" name="supplied_delete"  "btn btn-outline-danger">Delete</button>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Delete Supplied archived Product Modal -->
                @foreach ($archived_suppliedProducts as $archived_suppliedProduct)
                    <div class="modal fade" id="adminDeleteSuppliedProductModal{{$archived_suppliedProduct->id }}"
                        tabindex="-1" aria-labelledby="adminDeleteSuppliedProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Supplied product permanetly?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form
                                        action="{{ URL::signedRoute('admin.deleteSuppliedProduct', ['id' => $archived_suppliedProduct->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



                <!-- View archived Supplied Product Modal -->
                @foreach ($archived_suppliedProducts as $archived_suppliedProduct)
                    <div class="modal fade" id="viewSuppliedProductModal{{ $archived_suppliedProduct->id }}"
                        tabindex="-1" aria-labelledby="viewSuppliedProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ __('View Supplied Product Details') }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="h5"><strong>Supplied Product Company:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_suppliedProduct->company_supplied }}
                                    </p>
                                    <h5 class="h5"><strong>Deleted By:</strong></h5>
                                    <p class="text-justify">
                                        {{ ucwords($archived_suppliedProduct->user->name) }}
                                    </p>
                                    <h5 class="h5"><strong>Supplied Product Name:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_suppliedProduct->product_supplied }}
                                    </p>
                                    <h5 class="h5"><strong>Supplied Product Mobile:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_suppliedProduct->phone_supplied }}
                                    </p>
                                    <h5 class="h5"><strong>Quantity Product Supplied:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_suppliedProduct->quantity_supplied }}
                                    </p>


                                    <h5 class="h5"><strong>Unit Price:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_suppliedProduct->unit_price }}
                                    </p>
                                    <h5 class="h5"><strong>Total Amount of The Supplied Product:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_suppliedProduct->total_amount_supplied }}
                                    </p>
                                    <h5 class="h5"><strong>Supplied Product Address:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_suppliedProduct->address_supplied }}
                                    </p>

                                    <h5 class="h5"><strong>Date Deleted:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_suppliedProduct->deleted_at }}
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
            new simpleDatatables.DataTable("#view_archived_supplied_products", {})
        </script>
    @endpush
@endsection
