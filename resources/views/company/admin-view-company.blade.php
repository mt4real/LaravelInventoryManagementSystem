@extends('layouts.backend.backend_design')
@section('content')
<main class="content">
<div class="container-fluid p-0">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h1 class="page-title font-big">View Company</h1>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="view company">
                                view company
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="card rounded-3 border border-light">
            <div class="row">
                <div class="col-md-12 m-3">
                    @include('layouts.utilities.user-daialog')
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="view_company" class="table table-bordered table-striped mt-3">
                            <thead>
                                <tr>

                                    <th>Company Name</th>
                                    <th>Company Image</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($showCompany as $index => $showC)
                                    <tr>

                                        <td>{{ ucwords($showC->company_name) }}</td>
                                        <td><img src="{{ asset(config('app.companyImage').$showC->company_image) }}"
                                                class="img-fluid" width="40" height="40" alt="product image"></td>
                                        <td>{{ $showC->created_at }}</td>
                                        <td>{{ $showC->updated_at }}</td>

                                        <td>


                                            @if (Auth::guard('admin')->user()->can('editCompanyCreate', App\Models\Admin::class))
                                            @if (Auth::guard('admin')->user()->can('editCompanyStore', App\Models\Admin::class))

                                            <div class="btn-group" role="group" aria-label="edit company">
                                                <a href="{{ URL::signedRoute('admin.editCompany', ['id' => $showC->id]) }}"
                                                    role="button" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>

                                            </div>
                                            @endif
                                            @endif
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
    </div>
</main>
@endsection
