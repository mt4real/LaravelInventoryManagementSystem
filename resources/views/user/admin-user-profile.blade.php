@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">{{ __('Manage Profile') }}</h1>

            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">

                        <div class="card-body text-center">
                            <div id="userAvatar">

                            </div>

                            <div id="userImage">

                            </div>
                            <h5 class="card-title mb-0 profile_name text-capitalize">{{ ucwords(Auth::user()->name) }}</h5>
                            <div class="text-muted mb-2">{{ Auth::user()->role->role_name }}</div>

                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary btn-lg" data-bs-target="#userProfileModal"
                                    data-bs-toggle="modal">Upload Image</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDropdown" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  Upload Image
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDropdown">
                                  <li><a class="dropdown-item"  data-bs-target="#userProfileModal" data-bs-toggle="modal">Upload Image</a></li>
                                  <li><a class="dropdown-item" data-bs-target="#userProfileModal" data-bs-toggle="modal">Use Avatar</a></li>
                                </ul>
                              </div>
                        </div>
                        <hr class="my-0" />

                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">About</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a
                                        href="#">San Francisco, SA</a>
                                </li>

                                <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at
                                    <a href="#">GitHub</a>
                                </li>
                                <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> From <a
                                        href="#">Boston</a></li>
                            </ul>
                        </div>
                        <hr class="my-0" />

                    </div>
                    <!---upload image modal-->
                    <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userProfileModalLabel">Upload Profile Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="close"></button>
                                </div>
                                <form id="updateUserProfileImage" action="{{ route('admin.updateUserProfileImage') }}" method="post"
                                    enctype="multipart/form-data" id="updateUserProfileImage"
                                    accept="image/png, image/gif, image/jpeg,image/bmp,image/webp">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('layouts.utilities.custom_alert')
                                            </div>
                                        </div>
                                        <label for="image" class="mb-3">Upload Image</label>
                                        <input type="file" name="image" id="image"
                                            class="form-control form-control-lg mb-3 p-2" data-ajax-input="image">
                                        <span class="invalid-feedback" role="alert" data-ajax-feedback="image"></span>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-outline-primary">Upload Image</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!---upload avatar modal-->
                    <div class="modal fade" id="userAvtarModal" tabindex="-1" aria-labelledby="userAvatarModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userAvatarModalLabel">Upload Avatar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="close"></button>
                                </div>
                                <form id="updateUserAvatar" 
                                    accept="image/png">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('layouts.utilities.custom_alert')
                                            </div>
                                        </div>
                                        <p aria-labelled-by="Upload Avatar" class="mb-3">Upload Avatar</p>

                                        <span class="invalid-feedback" role="alert" data-ajax-feedback="image"></span>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-outline-primary">Upload Avatar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!---User profile msg info modal-->
                <div class="modal fade" id="userProfileMsgModal" tabindex="-1" aria-labelledby="userProfileMsgModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userProfileMsgModalLabel">User Profile Message info</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                You successfully updated your user info
                            </div>
                            <div class="modal-footer">

                                <button type="button" data-bs-dismiss="modal" class="btn btn-outline-danger">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <div class="card-header">

                        <h5 class="card-title mb-0">{{ __('Profile Details') }}</h5>
                    </div>
                    <div class="card-body h-100">

                        <form method="POST" action="{{ route('admin.updateUserInfo') }}" id="adminUserProfileForm">
                            @csrf
                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 mb-3 mt-4">
                                <label for="name" class="pb-2">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-lg text-capitalize @error('name') is-invalid @enderror"
                                    placeholder="Name" value="{{ ucwords(Auth::user()->name) }}" data-ajax-input="name">
                                <span class="invalid-feedback" role="alert" data-ajax-feedback="name"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 mb-3">
                                    <label for="email" class="pb-2">Email</label>
                                    <input type="text" name="email" id="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="Email" value="{{ Auth::user()->email }}" data-ajax-input="email">
                                    <span class="invalid-feedback" role="alert" data-ajax-feedback="email"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 mb-3 mt-4">
                                    <label for="mobile" class="pb-2">Mobile</label>
                                    <input type="text" name="phone" id="phone"
                                        class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                        placeholder="Mobile i.e +2347061843070" value="{{ Auth::user()->phone }}"
                                        data-ajax-input="phone">
                                    <span class="invalid-feedback" role="alert" data-ajax-feedback="phone"></span>
                                </div>

                                <div class="d-grid gap-2 col-6 mx-auto mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg">Change</button>
                                </div>

                                <div class="d-flex justify-content-start mt-5">
                                    <p
                                        style="font-size:1rem; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">
                                        {{ __('Change Password') }}</p>

                                </div>
                        </form>
                        <form method="post" id="userChangePasswordForm">
                            @csrf
                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 mb-3">
                                <label for="current_password" class="pb-2">Password</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control form-control-lg" placeholder="Current Password"
                                    data-ajax-input="current_password">
                                <span class="invalid-feedback" role="alert"
                                    data-ajax-feedback="current_password"></span>
                            </div>
                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 mb-3">
                                <label for="new_password" class="pb-2">New Password</label>
                                <input type="password" name="new_password" id="new_password"
                                    class="form-control form-control-lg " placeholder="New Password"
                                    data-ajax-input="new_password">
                                <span class="invalid-feedback" role="alert" data-ajax-feedback="new_password"></span>
                            </div>
                            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 mb-3">
                                <label for="confirmation_password" class="pb-2"> Password Confirmation</label>
                                <input type="password" name="confirmation_password" id="confirmation_password"
                                    class="form-control form-control-lg " placeholder="Confirmation Password"
                                    data-ajax-input="confirmation_password">
                                <span class="invalid-feedback" role="alert"
                                    data-ajax-feedback="confirmation_password"></span>
                            </div>
                            <div class="d-grid gap-2 col-10 mx-auto mt-5">
                                <button type="submit" class="btn btn-primary btn-lg ChangePswd" id="btnSubmit">Change
                                    Password</button>
                            </div>
                        </form>

                        <div class="d-flex justify-content-start mt-5">
                            <h3
                                style="font-size:1rem; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">
                                LogOut from Other device</h3>
                        </div>
                        <div class="d-flex justify-content-start">
                            <p>
                                <small>This will log you out from other devices you are expect the one you are currently log
                                    in</small>

                            </p>
                        </div>
                        <form>
                            <div class="d-grid col-6 mx-auto mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Log Out from Other devices</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </div>
        </div>
    </main>

    @include('layouts.utilities.general_modal')
@endsection
