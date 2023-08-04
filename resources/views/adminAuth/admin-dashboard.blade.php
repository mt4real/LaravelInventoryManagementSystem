@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
         <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3 h1">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>{{ucwords(Auth::guard('admin')->user()->name)}}</strong> {{__('Welcome back')}}</h3>
                </div>

                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="#" class="btn btn-light bg-white me-2">View Payment Sales</a>
                    <a href="{{route('admin.reportPage')}}" class="btn btn-primary">View Report</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Admin Users</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$countAdmUsers}}</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-primary-light"> <i class="mdi mdi-arrow-bottom-right"></i>{{$countAdmUsers}}</span>
                                            <span class="text-muted">No Of Admin Users</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Active Super Admin</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$countActiveSuperAdmUsers}}</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i>{{$countActiveSuperAdmUsers}}</span>
                                            <span class="text-muted">No of Active Super Admin Users</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Active Admin</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$countActiveAdmUsers}}</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i>{{$countActiveAdmUsers}}</span>
                                            <span class="text-muted">No of Active Admin Users</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Inactive Super Admin</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$countInactiveSuperAdmUsers}}</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i>{{$countInactiveSuperAdmUsers}}</span>
                                            <span class="text-muted">No Of Inactive Super Admin Users</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Inactive Admin</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$countInactiveAdmUsers}}</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-primary-light"> <i class="mdi mdi-arrow-bottom-right"></i>{{$countInactiveAdmUsers}}</span>
                                            <span class="text-muted">No of Inactive Admin Users</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Super Admin</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$countSuperAdmUsers}}</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i>{{$countSuperAdmUsers}}</span>
                                            <span class="text-muted">No of Super Admin Users</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100">

                    </div>
                </div>
            </div>

            <div class="row">

            </div>

            <div class="row">

            </div>

        </div>
    </main>

 @endsection
