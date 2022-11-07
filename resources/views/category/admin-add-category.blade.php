@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">Add Category</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('add category') }}
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
                                <h2 class=" h2 d-flex justify-content-center">{{ __('Add Category') }}</h2>
                            </div>
                            <div class="card-body">

                                <form id="adminAddCategory" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            <label for="category_name" class="mb-3">Category Name</label>
                                            <input type="text" class="form-control form-control-lg mb-3"
                                                id="category_name" name="category_name" placeholder="Category Name"
                                                data-ajax-input="category_name">
                                            <span class="invalid-feedback" role="alert"
                                                data-ajax-feedback="category_name"></span>
                                        </div>

                                    </div>
                                    <div class="d-grid col-8 mx-auto mt-2">
                                        <button type="submit" class="btn btn-primary btn-lg">Add Category</button>
                                    </div>
                            </div>

                        </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>

    @include('layouts.utilities.general_modal')
@endsection
