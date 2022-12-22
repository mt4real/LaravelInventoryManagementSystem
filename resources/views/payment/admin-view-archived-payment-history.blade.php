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
                    @if($archived_payments->count()>0)
                    @canany(['restoreArchivedPaymentsAll','deletePaymentPermanentlyAll'], App\Models\User::class)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" id="payment_checkAll"
                                    title="check to delete all the selected data">
                                <label class="form-check-label" for="check_all">
                                    Select all
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="d-grid gap-2">
                                <button class="paymentArchive_deleteAll  btn btn-primary btn-lg">Delete
                                    all</button>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="d-grid gap-2">
                                <button
                                    class="paymentsArchive_restoreAll btn btn-primary btn-lg">Restore
                                    all</button>
                            </div>

                        </div>

                    </div>
                    @endcanany
                    @endif
                    <div class="table-responsive">
                        <table id="view_archived_payment" class="table table-bordered table-striped border rounded mt-3">
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
                                        <th>Deleted By</th>
                                        <th>Date Created</th>
                                        <th>Date Deleted</th>
                                        <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($archived_payments->count())
                                @foreach ($archived_payments as $index => $archived_payment)
                                    <tr tr_{{ $archived_payment->id }}>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input paymentsArchivedCheck_checkbox" type="checkbox"
                                                    data-id="{{$archived_payment->id }}">
                                                <label class="form-check-label" for="supplied_ids">
                                                </label>

                                            </div>
                                        </td>
                                        <td>{{ ucwords($archived_payment->user->name) }}</td>
                                        <td>{{ $view_payment->customer_name}}</td>
                                            <td>{{ $view_payment->paid_amount}}</td>
                                            <td>{{ $view_payment->sales_amount}}</td>
                                            <td>{{ $view_payment->change_amount}}</td>
                                            <td>{{ $view_payment->payment_type}}</td>
                                            <td>{{Auth::user()->name}}</td>
                                            <td>{{$view_payment->created_at}}</td>
                                        <td>{{ $archived_payment->deleted_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="edit supplied product">

                                                <a href="#viewPaymentModal{{ $archived_payment->id }}"
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

                <!-- Restore multiple Payments Modal -->

                <div class="modal fade" id="adminRestoreMultiplePaymentsModal" tabindex="-1"
                    aria-labelledby="adminRestoreMultiplePaymentsModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               Restore The Selected payment record(s)
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Cancel</button>

                                <button type="submit" name="supplied_restore" class="btn btn-outline-primary">Restore</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete multiple payment Modal -->

                <div class="modal fade" id="adminDeleteMultiplePaymentModal" tabindex="-1"
                    aria-labelledby="adminDeleteMultiplePaymentModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the selected
                                payment record(s) permanently?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Cancel</button>

                                <button type="submit" name="supplied_delete"  " btn btn-outline-danger">Delete</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- View archived Payment Modal -->
                @foreach ($archived_payments as $archived_payment)
                    <div class="modal fade" id="viewPaymentModal{{ $archived_payment->id }}"
                        tabindex="-1" aria-labelledby="viewPaymentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="paymentModalLabel">
                                        {{ __('View Payment Details') }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="h5"><strong>Sales Person:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_payment->user->name}}
                                    </p>
                                    <h5 class="h5"><strong>Customer Name:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_payment->customer_name}}
                                    </p>
                                    <h5 class="h5"><strong>Paid Amount:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_payment->paid_amount}}
                                    </p>
                                    <h5 class="h5"><strong>Sales Amount:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_payment->sales_amount}}
                                    </p>
                                    <h5 class="h5"><strong>Change Amount:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_payment->change_amount}}
                                    </p>
                                    <h5 class="h5"><strong>Payment Type:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_payment->payment_type}}
                                    </p>

                                    <h5 class="h5"><strong>Deleted By:</strong></h5>
                                    <p class="text-justify">
                                        {{ ucwords(Auth::user()->name) }}
                                    </p>
                                    <h5 class="h5"><strong>Date Created:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_payment->created_at}}
                                    </p>

                                    <h5 class="h5"><strong>Date Deleted:</strong></h5>
                                    <p class="text-justify">
                                        {{ $archived_payment->deleted_at}}
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
            new simpleDatatables.DataTable("#view_archived_payment", {})
        </script>
    @endpush
@endsection
