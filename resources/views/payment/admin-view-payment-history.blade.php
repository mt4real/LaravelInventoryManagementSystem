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
                                        {{ __('view payment') }}
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
                        @if ($view_payments ->count()>0)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input paymentsCheck_all" type="checkbox" id="paymentsCheck_all"
                                        title="check to archive all the selected data">
                                    <label class="form-check-label" for="suppliedProductCheck_all">
                                        Select all
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-grid col-6">
                                    <a href="#" class="payments_archiveAll btn btn-primary btn-lg" role="button">Archive
                                        all</a>
                                </div>
                            </div>

                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="view_payments"
                                class="table table-bordered table-striped border rounded mt-3">

                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>#</th>
                                        <th>Sales Person</th>
                                        <th>Customer Name</th>
                                        <th>Paid Amount</th>
                                        <th>Sales Amount</th>
                                        <th>Change Amount</th>
                                        <th>Payment Type</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_payments  as $index => $view_payment)
                                        <tr tr_{{ $view_payment->id }}>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input paymentsCheck_checkbox" type="checkbox"
                                                        id="payment_ids" name="payment_ids[]"
                                                        value="{{ $view_payment->id }}"
                                                        data-id="{{ $view_payment->id }}">
                                                    <label class="form-check-label" for="payment checkbox">

                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ ucwords($view_payment->user->name) }}</td>
                                            <td>{{ $view_payment->customer_name}}</td>
                                            <td>{{ $view_payment->paid_amount}}</td>
                                            <td>{{ $view_payment->sales_amount}}</td>
                                            <td>{{ $view_payment->change_amount}}</td>
                                            <td>{{ $view_payment->payment_type}}</td>
                                            <td>{{ $view_payment->created_at }}</td>
                                            <td>{{ $view_payment->updated_at }}</td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="view payment history">
                                                 <a href="#viewPaymentModal{{ $view_payment->id }}"
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



            <!-- Archive multiple payments Modal -->

            <div class="modal fade" id="adminArchivedMultiplePaymentsModal" tabindex="-1"
                aria-labelledby="adminArchivedMultiplePaymentsModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to archive the selected  payment record(s)?
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
            @foreach ($view_payments  as $view_payment)
                <div class="modal fade" id="viewPaymentModal{{ $view_payment->id }}" tabindex="-1"
                    aria-labelledby="viewPaymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('View Payment Details') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="h5"><strong>Sales Person:</strong></h5>
                                <p class="text-justify">
                                    {{$view_payment->user->name}}
                                </p>
                                <h5 class="h5"><strong>Paid Amount:</strong></h5>
                                <p class="text-justify">
                                    {{$view_payment->paid_amount}}
                                </p>
                                <h5 class="h5"><strong>Sales Amount:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_payment->sales_amount}}
                                </p>
                                <h5 class="h5"><strong>Change Amount:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_payment->change_amount}}
                                </p>
                                <h5 class="h5"><strong>Payment Type:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_payment->payment_type}}
                                </p>

                                <h5 class="h5"><strong>Date Created:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_payment->created_at }}
                                </p>
                                <h5 class="h5"><strong>Date Updated:</strong></h5>
                                <p class="text-justify">
                                    {{ $view_payment->updated_at }}
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
            new simpleDatatables.DataTable("#view_payments", {})
        </script>
    @endpush
@endsection
