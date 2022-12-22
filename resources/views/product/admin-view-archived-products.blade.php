@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">{{ __('View Archived Product') }}</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('view archived product ') }}
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

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 colxs-12 mt-5">
                        @include('layouts.utilities.user-daialog')
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 colxs-12 mt-5">
                        @include('layouts.utilities.custom_alert')
                    </div>
                </div>
                <div class="card rounded-3 border border-light">
                    <div class="card-body">
                       @if ($archived_products->count()>0)
                       @canany(['deleteProductPermanentlyAll','restoreArchivedProductAll'], App\Models\User::class)
                       <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" id="archiveProduct_checkAll"
                                    title="check to delete all the selected data">
                                <label class="form-check-label" for="check_all">
                                    Select all
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="d-grid gap-2">
                                <button class="archiveProduct_deleteAll btn btn-primary btn-lg">Delete
                                    all</button>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="d-grid gap-2">
                                <button
                                    class="archiveProduct_restoreAll btn btn-primary btn-lg">Restore
                                    all</button>
                            </div>

                        </div>

                       </div>
                       @endcanany
                       @endif
                            <div class="table-responsive">
                                <table id="view_archived_products" class="table table-bordered border rounded table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th>Product Quantity</th>
                                            <th>Sale Price</th>
                                            <th>Total Amount</th>
                                            <th>Deleted By</th>
                                            <th>Date Deleted</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($archived_products as $index => $archived_product)
                                            <tr _tr{{$archived_product->id}}>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input archiveProduct_checkbox" type="checkbox"
                                                            data-id="{{ $archived_product->id }}">
                                                        <label class="form-check-label" for="archiveProduct_checkbox">
                                                        </label>

                                                    </div>
                                                </td>
                                                <td>{{ $archived_product->category->category_name }}</td>
                                                <td>{{ $archived_product->product_name }}</td>
                                                <td>{{ $archived_product->product_quantity }}</td>
                                                <td>{{ $archived_product->sale_price }}</td>
                                                <td>{{ $archived_product->total_amount }}</td>
                                                <td>{{ ucwords(Auth::user()->name) }}</td>
                                                <td>{{ $archived_product->deleted_at }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="product actions">
                                                        <a href="#viewArchivedProductModal{{ $archived_product->id }}"
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
            </div>

            <!-- Restore multiple Product Modal -->

            <div class="modal fade" id="adminRestoreMultipleSuppliedProductModal" tabindex="-1"
                aria-labelledby="adminRestoreMultipleSuppliedProductModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Restore The Selected Products
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-outline-primary">Restore</button>

                        </div>
                    </div>
                </div>
            </div>

            <!--mutile delete Product Modal -->

            <div class="modal fade" id="adminDeleteMultipleProductModal" tabindex="-1"
                aria-labelledby="adminDeleteMultipleProductModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the selected
                            product(s) permanently?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-outline-danger">Delete</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- View Product Modal -->
            @foreach ($archived_products as $archived_product)
                <div class="modal fade" id="viewArchivedProductModal{{ $archived_product->id }}" tabindex="-1"
                    aria-labelledby="viewArchivedProductModalLabel" aria-hidden="true">
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
                                    {{ $archived_product->category->category_name }}
                                </p>

                                <h5 class="h5"><strong>Product Name:</strong></h5>
                                <p class="text-justify">
                                    {{ $archived_product->product_name }}
                                </p>
                                <h5 class="h5"><strong>Product Brand:</strong></h5>
                                <p class="text-justify">
                                    {{ $archived_product->phone_supplied }}
                                </p>
                                <h5 class="h5"><strong>Quantity Product Supplied:</strong></h5>
                                <p class="text-justify">
                                    {{ $archived_product->product_quantity }}
                                </p>
                                <h5 class="h5"><strong>Sale Price:</strong></h5>
                                <p class="text-justify">
                                    {{ $archived_product->sale_price }}
                                </p>
                                <h5 class="h5"><strong>Total Amount of The Product:</strong></h5>
                                <p class="text-justify">
                                    {{ $archived_product->total_amount }}
                                </p>
                                <h5 class="h5"><strong>Product Status:</strong></h5>
                                <p class="text-justify">
                                    {{ $archived_product->product_status }}
                                </p>
                                <h5 class="h5"><strong>Date Created:</strong></h5>
                                <p class="text-justify">
                                    {{ $archived_product->created_at }}
                                </p>
                                <h5 class="h5"><strong>Date Updated:</strong></h5>
                                <p class="text-justify">
                                    {{ $archived_product->updated_at }}
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
            new simpleDatatables.DataTable("#view_archived_products", {})
        </script>
    @endpush
@endsection
