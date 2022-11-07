@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h1 class="page-title font-big">View User</h1>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        view user
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-5">

                <div class="card rounded-3 border border-light">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="view_user" class="table table-bordered border rounded table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin_users as $index => $admin_user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ ucwords($admin_user->name) }}</td>
                                            <td>{{ $admin_user->email }}</td>
                                            <td>
                                                @if (!empty($admin_user->image))
                                                    <img src="{{ asset(config('app.userImage') . $admin_user->image) }}"
                                                        class="img-fluid" width="40" height="40" alt="User image">
                                                @else
                                                    <img src="{{ Avatar::create(ucwords(Auth::user()->name))->toBase64() }}"
                                                        class="rounded-circle" width="40" alt="Profile avatar" />
                                                @endif
                                            </td>

                                            <td>{{ $admin_user->created_at }}</td>
                                            <td>{{ $admin_user->updated_at }}</td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="edit company">
                                                    @canany(['addUserCreate','deleteUser'], App\Models\User::class)
                                                    <a href="{{ URL::signedRoute('admin.editUser', ['id' => $admin_user->id]) }}"
                                                        role="button" class="btn btn-primary"><i
                                                            class="fas fa-edit"></i>Edit</a>
                                                    <a href="#adminDeleteUserModal{{ $admin_user->id }}" role="button"
                                                        data-bs-toggle="modal" class="btn btn-danger"><i
                                                            class="fas fa-trash"></i>Delete</a>
                                                            @endcanany
                                                    <a href="#adminViewUserModal{{ $admin_user->id }}" role="button"
                                                        data-bs-toggle="modal" class="btn btn-primary"
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
            </div>

            <!-- Delete user Modal -->
            @foreach ($admin_users as $admin_user)
                <div class="modal fade" id="adminDeleteUserModal{{ $admin_user->id }}" tabindex="-1"
                    aria-labelledby="adminDeleteUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ URL::signedRoute('admin.deleteUser', ['id' => $admin_user->id]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



            <!-- View user Modal -->
            @foreach ($admin_users as $admin_user)
                <div class="modal fade" id="adminViewUserModal{{ $admin_user->id }}" tabindex="-1"
                    aria-labelledby="adminViewUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">View User Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5 class="h5"><strong>Name:</strong></h5>
                                <p class="text-justify">
                                    {{ $admin_user->name }}
                                </p>
                                <h5 class="h5"><strong>Email:</strong></h5>
                                <p class="text-justify">
                                    {{ $admin_user->email }}
                                </p>

                                <h5 class="h5"><strong>Image:</strong></h5>
                                <p class="text-justify">
                                    @if (empty($admin_user->image))
                                        <img src="{{ Avatar::create(ucwords($admin_user->name)) }}" alt="user avatar">
                                    @else
                                        <img src="{{ asset(config('app.userImage') . $admin_user->image) }}"
                                            class="img-fluid img-thumbnail" alt="user image">
                                    @endif
                                </p>
                                <h5 class="h5"><strong>Date Verified:</strong></h5>
                                <p class="text-justify">
                                    {{ $admin_user->email_verified_at }}
                                </p>
                                <h5 class="h5"><strong>User Role:</strong></h5>
                                <p class="text-justify">
                                    {{ $admin_user->role->role_name }}
                                </p>
                                <h5 class="h5"><strong>User Status:</strong></h5>
                                <p class="text-justify">
                                    {{ $admin_user->user_status }}
                                </p>

                                <h5 class="h5"><strong>Date Created:</strong></h5>
                                <p class="text-justify">
                                    {{ $admin_user->created_at }}
                                </p>
                                <h5 class="h5"><strong>Date Updated:</strong></h5>
                                <p class="text-justify">
                                    {{ $admin_user->updated_at }}
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
 new simpleDatatables.DataTable("#view_user", {})
    </script>
@endpush
@endsection
