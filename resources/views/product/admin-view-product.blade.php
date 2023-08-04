@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">{{ __('View Product') }}</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('view product ') }}
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
                        @if ($view_products->count()>0)
                        @canany(['archiveProductAll'], App\Models\User::class)
                        <div class="row">
                           <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="product_check_all"
                                        title="check to delete all the selected data">
                                    <label class="form-check-label" for="product_check_all">
                                        Select all
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-8">

                                <div class="d-grid gap-2">
                                    <button class="product_delete_all btn btn-primary btn-lg">Delete
                                        all</button>
                                </div>
                            </div>

                        </div>
                        @endcanany
                        @endif
                        <form action="{{route('admin.archivedProductAll')}}"
                            method="post">
                            @csrf
                        <div class="table-responsive">
                            <table id="view_products" class="table table-bordered border rounded table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Sale Price</th>
                                        <th>Defect Product</th>
                                        <th>Total Amount</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_products as $index => $view_product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input product_checkbox" type="checkbox"
                                                        id="product_ids" name="product_ids[]"
                                                        value="{{$view_product->id }}"
                                                        data-id="{{$view_product->id }}">
                                                    <label class="form-check-label" for="supplied_check">
                                                    </label>

                                                </div>
                                            </td>
                                            <td>{{ucwords($view_product->category->category_name)}}</td>
                                            <td>{{ ucwords($view_product->product_name )}}</td>
                                            <td>{{ $view_product->product_quantity }}</td>
                                            <td>{{ $view_product->sale_price }}</td>
                                            @if (empty($view_product->product_defect))
                                              <td>{{"Nill"}}</td>
                                              @else
                                              <td>{{ $view_product->product_defect}}</td>
                                            @endif
                                            <td>{{ $view_product->total_amount }}</td>
                                            <td>{{ $view_product->created_at }}</td>
                                            <td>{{ $view_product->updated_at }}</td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="product actions">
                                                    @canany(['updateExistingProductCreate','editProductCreate'], App\Models\Admin::class)
                                                    <a href="{{ URL::signedRoute('admin.editProduct', ['id' => $view_product->id]) }}"
                                                        role="button" class="btn btn-primary"><i
                                                            class="fas fa-edit"></i>Edit</a>
                                                            <a href="{{ URL::signedRoute('admin.existingProduct', ['id' => $view_product->id]) }}"
                                                                role="button" class="btn btn-primary" title="Update the quntity of the existing product">
                                                                <i class="fa-solid fa-pen-to-square"></i>Update</a>
                                                                    @endcanany
                                                    <a href="#adminDeleteProductModal{{ $view_product->id }}"
                                                        role="button" data-bs-toggle="modal" class="btn btn-danger"><i
                                                            class="fas fa-trash"></i>Delete</a>
                                                    <a href="#viewProductModal{{ $view_product->id }}" role="button"
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
            @foreach ($view_products as $view_product)
                <div class="modal fade" id="adminDeleteProductModal{{ $view_product->id }}" tabindex="-1"
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
                                <form action="{{ URL::signedRoute('admin.archivedProduct', ['id' => $view_product->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">Archive</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



            <!-- View Product Modal -->
            @foreach ($view_products as $view_product)
                <div class="modal fade" id="viewProductModal{{ $view_product->id }}" tabindex="-1"
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
                                    {{ $view_product->category->category_name}}
                                </p>

                                <h5 class="h5"><strong>Product Name:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_product->product_name }}
                                </p>

                                <h5 class="h5"><strong>Quantity Product Supplied:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_product->product_quantity }}
                                </p>
                                <h5 class="h5"><strong>Sale Price:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_product->sale_price }}
                                </p>
                                <h5 class="h5"><strong>Defect Product:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_product->product_defect }}
                                </p>
                                <h5 class="h5"><strong>Total Amount of The Product:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_product->total_amount }}
                                </p>
                                <h5 class="h5"><strong>Product Status:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_product->product_status }}
                                </p>
                                <h5 class="h5"><strong>Date Created:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_product->created_at }}
                                </p>
                                <h5 class="h5"><strong>Date Updated:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_product->updated_at }}
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
 new simpleDatatables.DataTable("#view_products", {})
    </script>
@endpush
@endsection
