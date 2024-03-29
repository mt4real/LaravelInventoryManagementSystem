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
                                        {{ __('view sales history') }}
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
                    <form action="{{ route('admin.archiveSalesHistoryAll') }}" method="POST">
                        @csrf
                        @if ($view_salesHistory ->count()>0)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input salesHistoryCheck_all" type="checkbox" id="salesHistoryCheck_all"
                                        title="check to archive all the selected data">
                                    <label class="form-check-label" for="suppliedProductCheck_all">
                                        Select all
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-grid col-6">
                                    <a href="#" class="salesHistory_archiveAll btn btn-primary btn-lg" role="button">Archive
                                        all</a>
                                </div>
                            </div>

                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="view_salesHistory"
                                class="table table-bordered table-striped border rounded mt-3">

                                <thead>
                                    <tr>
                                     <th>S/N</th>
                                    <th>#</th>
                                    <th>Sales Person</th>
                                    <th>Product Name</th>
                                    <th>Quantity Sales</th>
                                    <th>Quantity Remain</th>
                                    <th>Sales Price</th>
                                    <th>Total Amount</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_salesHistory  as $index => $view_saleHistory)
                                        <tr tr_{{ $view_saleHistory->id }}>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input salesHistoryCheck_checkbox" type="checkbox"
                                                        id="salesHistory_ids" name="salesHistory_ids[]"
                                                        value="{{ $view_saleHistory->id }}"
                                                        data-id="{{ $view_saleHistory->id }}">
                                                    <label class="form-check-label" for="salesHistory checkbox">

                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ ucwords($view_saleHistory->user->name) }}</td>
                                            <td>{{ $view_saleHistory->addProduct->product_name}}</td>
                                            <td>{{ $view_saleHistory->quantity_sales}}</td>
                                            <td>{{ $view_saleHistory->quantity_remain}}</td>
                                            <td>{{ $view_saleHistory->sales_price}}</td>
                                            <td>{{ $view_saleHistory->total_amount}}</td>
                                            <td>{{ $view_saleHistory->created_at }}</td>
                                            <td>{{ $view_saleHistory->updated_at }}</td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="view payment history">
                                                 <a href="#viewSalesHistoryModal{{ $view_saleHistory->id }}"
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



            <!-- Archive multiple sales history Modal -->

            <div class="modal fade" id="adminArchivedMultipleSalesHistoryModal" tabindex="-1"
                aria-labelledby="adminArchivedMultipleSalesHistoryModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to archive the selected  sales history record(s)?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-outline-danger">Archive</button>

                        </div>
                    </div>
                </div>
            </div>

        </form>


            <!-- View Payment Modal -->
            @foreach ($view_salesHistory  as $view_saleHistory)
                <div class="modal fade" id="viewSalesHistoryModal{{ $view_saleHistory->id }}" tabindex="-1"
                    aria-labelledby="viewSalesHistoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('View Sales History Details') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="h5"><strong>Sales Person:</strong></h5>
                                <p class="text-justify">
                                    {{$view_saleHistory->user->name}}
                                </p>
                                <h5 class="h5"><strong>Product Name:</strong></h5>
                                <p class="text-justify">
                                    {{$view_saleHistory->product_name}}
                                </p>
                                <h5 class="h5"><strong>Quantity Sales:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_saleHistory->quantity_sales}}
                                </p>
                                <h5 class="h5"><strong>Quantity Remain:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_saleHistory->quantity_remain}}
                                </p>
                                <h5 class="h5"><strong>Sales Price:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_saleHistory->sales_price}}
                                </p>
                                <h5 class="h5"><strong>Total Amount:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_saleHistory->total_amount}}
                                </p>

                                <h5 class="h5"><strong>Date Created:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_saleHistory->created_at }}
                                </p>
                                <h5 class="h5"><strong>Date Updated:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_saleHistory->updated_at }}
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
            new simpleDatatables.DataTable("#view_salesHistory", {})
        </script>
    @endpush
@endsection
