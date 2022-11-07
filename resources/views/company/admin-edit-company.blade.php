@extends('layouts.backend.backend_design')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                @include('layouts.utilities.user-daialog')
            </div>
            <div class="col-12 d-flex no-block align-items-center">

                <h1 class="page-title font-big">{{__('Edit Company')}}</h1>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{__('edit company')}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-8">
                <div class="card  rounded-3  border border-light ">
                    <div class="card-title bg-white mt-3">
                        <h2 class=" h2 d-flex justify-content-center">{{__('Edit Company Details')}}</h2>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('admin.editCompany', ['id' => $edit_company->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                    <label for="company_name">{{ __('Company Name') }}</label>
                                    <input type="text" name="company_name" id="company_name"
                                        class="form-control form-control-lg   @error('company_name') is-invalid @enderror"
                                        placeholder="Company Name" autofocus value="{{ $edit_company->company_name }}">
                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3 ">
                                    <label for="company_mobile">{{ __('Company Mobile') }}</label>
                                    <input type="text" name="company_mobile" id="company_mobile"
                                        class="form-control form-control-lg   @error('company_mobile') is-invalid @enderror"
                                        placeholder="Company Mobile" autofocus value="{{ $edit_company->company_mobile}}">
                                    @error('company_mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="company_email">{{ __('Company Email') }}</label>
                                    <input type="text" name="company_email" id="company_email"
                                        class="form-control form-control-lg   @error('company_email') is-invalid @enderror"
                                        placeholder="Company email"  value="{{ $edit_company->company_email}}">
                                    @error('company_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <label for="company_image" class="mb-3">{{ __('Company Image') }}</label>
                                    <input type="file" name="company_image" id="company_image" accept="image/*"
                                        class="form-control form-control-lg mb-3">
                                    @error('company_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if ($edit_company->company_image)
                                        <input type="hidden" name="current_image" id="current_image"
                                            value="{{ $edit_company->company_image }}">
                                    @endif
                                    @if ($edit_company->company_image)
                                        <img src="{{ asset(config('app.companyImage') . $edit_company->company_image) }}"
                                            class="img-fluid" width="50" height="50" alt="company image">|<a
                                            href="{{ URL::signedRoute('admin.deleteCompanyImage', ['id' => $edit_company->id]) }}"
                                            class="btn btn-primary btn-sm" role="button">Delete</a>
                                    @endif
                                </div>
                            </div>

                            <div class="d-grid col-8 mx-auto mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Edit Company Details</button>
                            </div>
                    </div>

                </div>

                </form>
            </div>
        </div>
    </div>
@endsection
