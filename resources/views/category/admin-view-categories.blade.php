@extends('layouts.backend.backend_design')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h1 class="page-title font-big">View Category</h1>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                view category
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
                        <table id="view_categories" class="table table-bordered border rounded table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Category Name</th>
                                    <th>Category Status</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($view_categories as $index => $view_category)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{ ucwords($view_category->category_name) }}</td>
                                        <td>{{ $view_category->category_status }}</td>
                                        <td>{{ $view_category->created_at }}</td>
                                        <td>{{ $view_category->updated_at }}</td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="category actions">
                                                @canany(['deleteCategory','editCategoryCreate'], App\Models\User::class)
                                                <a href="{{ URL::signedRoute('admin.editCategory', ['id' => $view_category->id]) }}"
                                                    role="button" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                                <a href="#adminDeleteCategoryModal{{$view_category->id}}"
                                                    role="button" data-bs-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</a>
                                                    @endcanany
                                                    <a href="#adminViewCategoryModal{{$view_category->id}}"
                                                        role="button" data-bs-toggle="modal" class="btn btn-primary"><i class="fas fa-eye"></i>View</a>
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
         <!-- Delete Category Modal -->
    @foreach ($view_categories as $view_category)
    <div class="modal fade" id="adminDeleteCategoryModal{{$view_category->id }}" tabindex="-1"
        aria-labelledby="adminDeleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ URL::signedRoute('admin.deleteCategory', ['id' => $view_category->id]) }}"
                        method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

     <!-- View Category Modal -->
     @foreach ($view_categories as $view_category)
     <div class="modal fade" id="adminViewCategoryModal{{ $view_category->id }}"
         tabindex="-1" aria-labelledby="adminViewCategoryModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">
                         {{ __('View Category Details') }}
                     </h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <h5 class="h5"><strong>Category Name:</strong></h5>
                     <p class="text-justify">
                         {{ $view_category->category_name}}
                     </p>
                     <h5 class="h5"><strong>Category Status:</strong></h5>
                     <p class="text-justify">
                         {{ $view_category->category_status}}
                     </p>
                     <h5 class="h5"><strong>Created Date</strong></h5>
                     <p class="text-justify">
                         {{ ucwords($view_category->created_at) }}
                     </p>
                     <h5 class="h5"><strong>Updated Date</strong></h5>
                     <p class="text-justify">
                         {{ ucwords($view_category->updated_at) }}
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
    new simpleDatatables.DataTable("#view_categories", {})

</script>
@endpush
@endsection
