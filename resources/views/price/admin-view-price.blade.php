@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">{{ __('View Price') }}</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('view price') }}
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
                        <div class="table-responsive">
                            <table id="view_prices" class="table table-bordered border rounded table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Sale Price</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($price_views as $index => $price_view)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $price_view->category->category_name }}</td>
                                            <td>{{ $price_view->product_name }}</td>
                                            <td>{{ $price_view->product_quantity }}</td>
                                            <td>{{ $price_view->sale_price }}</td>
                                            <td>{{ $price_view->created_at }}</td>
                                            <td>{{ $price_view->updated_at }}</td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="product price actions">
                                                    @canany(['updateExistingProductCreate'], App\Models\Admin::class)
                                                    <a href="{{ URL::signedRoute('admin.changePrice', ['id' => $price_view->id]) }}"
                                                        role="button" class="btn btn-primary"><i
                                                            class="fas fa-edit"></i>Edit</a>
                                                        @endcanany
                                                    <a href="#viewProductPriceModal{{ $price_view->id }}" role="button"
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


            <!-- View Price Modal -->
            @foreach ($price_views as $price_view)
                <div class="modal fade" id="viewProductPriceModal{{ $price_view->id }}" tabindex="-1"
                    aria-labelledby="viewProductPriceModalLabel" aria-hidden="true">
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
                                    {{ $price_view->category->category_name }}
                                </p>

                                <h5 class="h5"><strong>Product Name:</strong></h5>
                                <p class="text-justify">
                                    {{ $price_view->product_name }}
                                </p>
                                <h5 class="h5"><strong>Sale Price:</strong></h5>
                                <p class="text-justify">
                                    {{ $price_view->sale_price }}
                                </p>

                                <h5 class="h5"><strong>Product Status:</strong></h5>
                                <p class="text-justify">
                                    {{ $price_view->product_status }}
                                </p>
                                <h5 class="h5"><strong>Date Created:</strong></h5>
                                <p class="text-justify">
                                    {{ $price_view->created_at }}
                                </p>
                                <h5 class="h5"><strong>Date Updated:</strong></h5>
                                <p class="text-justify">
                                    {{ $price_view->updated_at }}
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
            new simpleDatatables.DataTable("#view_prices", {})
        </script>
    @endpush
@endsection
