@extends('layouts.backend.backend_design')
@section('content')
<main class="content">
<div class="container-fluid">

    <div class="page-breadcrumb">
        <div class="row">

            <div class="col-12 d-flex no-block align-items-center">
                <h1 class="page-title font-big">{{__('Edit User')}}</h1>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{__('edit user')}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                @include('layouts.utilities.user-daialog')
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-8">
                <div class="card  rounded-3  border border-light ">
                    <div class="card-title bg-white mt-3">
                        <h2 class=" h2 d-flex justify-content-center ">Edit User</h2>
                    </div>
                    <div class="card-body">

                        <form action="{{route('admin.editUser',['id'=>$edit_user->id])}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row ">
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                    <label for="name" class="mb-3">Name</label>
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror mb-3" id="name"
                                        name="name" placeholder="Name" value="{{$edit_user->name}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 mb-3">
                                    <label for="email" class="mb-3">Email</label>
                                    <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror mb-3" name="email"
                                        id="email" placeholder="Email" value="{{$edit_user->email}}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                </div>

                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="user_image" class="mb-3">Image</label>
                                    <input type="file" name="user_image" id="user_image" accept="image/*"
                                        class="form-control form-control-lg mb-3 @error('user_image') is-invalid @enderror"
                                        >
                                        @error('user_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                        @if ($edit_user->image)
                                        <input type="hidden" name="current_image" id="current_image"
                                            value="{{ $edit_user->image }}">
                                    @endif
                                    @if ($edit_user->image)
                                        <img src="{{ asset(config('app.userImage') . $edit_user->image) }}"
                                            class="img-fluid" width="50" height="50" alt="user image">|<a
                                            href="{{ URL::signedRoute('admin.deleteUserImage', ['id' => $edit_user->id]) }}"
                                            class="btn btn-primary btn-sm" role="button">Delete</a>
                                    @endif
                                </div>

                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="user_role" class="mb-3">Role</label>
                                    <select type="file" name="role_id" id="role_id"
                                        class="form-control form-control-lg mb-3 @error('role_id') is-invalid @enderror"
                                        >
                                        <option disabled selected>Select role</option>
                                        @foreach ($user_roles as $user_role )
                                            <option value="{{$user_role->id}}" @if ($edit_user->role_id===$user_role->id)
                                                selected @endif>{{$user_role->role_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">

                                    <label for="user_status">User Status</label>
                                    <select class="form-select form-select-lg mb-3" id="user_status"
                                        name="user_status">

                                        @foreach (['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE'] as $user_status => $userStatusLabel)
                                            <option value="{{ $user_status }}"
                                                {{ old('user_status', $edit_user->user_status) === $user_status ? 'selected' : '' }}>
                                                {{ $userStatusLabel }}
                                        @endforeach
                                        </option>
                                    </select>

                                </div>

                            </div>
                            <div class="d-grid col-8 mx-auto mt-2">
                                <button type="submit" class="btn btn-primary btn-lg">Edit User</button>
                            </div>
                    </div>

                </div>

                </form>
            </div>
            @include('layouts.utilities.general_modal')
        </div>
    </div>

</div>
</main>
@endsection
