@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">User</h1><a class="badge bg-primary ms-2"
                    href="{{ route('admin.userReg') }}" role="button">add user<i
                        class="fas fa-fw fa-external-link-alt"></i></a>
            </div>
                <div class="row">
                    <div class="col-8">
                        <div class="card  rounded-3  border border-light ">
                            <div class="card-header">
                                <h5 class="card-title">user</h5>
                                <h6 class="card-subtitle text-muted">Add user below.</h6>
                            </div>
                            <div class="card-body">

                                <form id="adminUserRegForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="name" class="mb-3">Name</label>
                                            <input type="text" class="form-control form-control-lg mb-3" id="name"
                                                name="name" placeholder="Name" data-ajax-input="name">
                                            <span class="invalid-feedback" role="alert" data-ajax-feedback="name"></span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="email" class="mb-3">Email</label>
                                            <input type="text" class="form-control form-control-lg mb-3" name="email"
                                                id="email" placeholder="Email" data-ajax-input="email">
                                            <span class="invalid-feedback" role="alert" data-ajax-feedback="email"></span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="password" class="mb-3">Password</label>
                                            <input type="password" class="form-control form-control-lg mb-3" name="password"
                                                id="password" placeholder="Passoword" data-ajax-input="password">
                                            <span class="invalid-feedback" role="alert"
                                                data-ajax-feedback="password"></span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                            <label for="password_confirmation"class="mb-3">Confirm Password</label>
                                            <input type="password" class="form-control form-control-lg mb-3"
                                                name="password_confirmation" id="password_confirmation"
                                                placeholder="Confirmation Password" data-ajax-input="password_confirmation">
                                            <span class="invalid-feedback" role="alert"
                                                data-ajax-feedback="password_confirmation"></span>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                            <label for="user_image" class="mb-3">Image</label>
                                            <input type="file" name="user_image" id="user_image" accept="image/*"
                                                class="form-control form-control-lg mb-3" data-ajax-input="company_image">
                                            <span class="invalid-feedback" role="alert"
                                                data-ajax-feedback="user_image"></span>
                                        </div>

                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                            <label for="user_role" class="mb-3">Role</label>
                                            <select type="file" name="role_id" id="role_id"
                                                class="form-control form-control-lg mb-3" data-ajax-input="role_id">
                                                <option disabled selected>Select role</option>
                                                @foreach ($user_roles as $user_role)
                                                    <option value="{{ $user_role->id }}">{{ $user_role->role_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback" role="alert"
                                                data-ajax-feedback="role_id"></span>
                                        </div>


                                    </div>
                                    <div class="d-grid col-8 mx-auto mt-2">
                                        <button type="submit" class="btn btn-primary btn-lg">Add User</button>
                                    </div>
                            </div>

                        </div>

                        </form>
                    </div>
                    @include('layouts.utilities.general_modal')
                </div>
             </div>
        </main>
@endsection
