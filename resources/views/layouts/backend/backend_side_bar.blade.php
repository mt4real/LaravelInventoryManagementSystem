
  <nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('admin.dashboard')}}">
            <span class="sidebar-brand-text align-middle">
                {{config('app.companyName')}}
                <sup><small class="badge bg-primary text-uppercase">{{__('Dashboard')}}</small></sup>
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5"
                stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    @if(empty(Auth::user()->image))
                    <img src="{{ Avatar::create(ucwords(Auth::user()->name))->toBase64() }}" class="rounded-circle"
                            width="31"  alt="Profile avatar"/>

                    </a>
                    @else
                    <a class=" nav-link dropdown-toggle text-muted
                    waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="{{ asset(config('app.userImage').Auth::user()->image) }}"  class="rounded-circle"
                            width="31" alt="Profile image" />
                            @endif
                    </a>
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{ucwords(Auth::user()->name)}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="{{route('admin.userProfile')}}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('admin.settings')}}"><i class="align-middle me-1" data-feather="settings"></i> Settings
                            </a>
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-power-off me-2"></i>Log out</a>
                    </div>

                    <div class="sidebar-user-subtitle">{{Auth::user()->role->role_name}}</div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                {{__('Menu')}}
            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{route('admin.dashboard')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#company" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Company</span>
                </a>
                <ul id="company" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewCompany')}}">View company details</a></li>
                </ul>
            </li>

            @canany(['addUserCreate','viewUsers'], App\Models\User::class)
            <li class="sidebar-item">

                <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">User</span>
                </a>

                <ul id="users" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">

                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.userReg')}}">Add user</a></li>

                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewUsers')}}">View user(s)</a></li>
                </ul>
            </li>
            @endcanany
            <li class="sidebar-item">
                <a data-bs-target="#categories" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Category</span>
                </a>
                <ul id="categories" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    @canany(['addCategoryCreate'], App\Models\User::class)
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.addCategory')}}">Add category</a></li>
                    @endcanany
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewCategory')}}">View Categories</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#product" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="speaker"></i> <span class="align-middle">Product</span>
                </a>
                <ul id="product" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    @canany(['productCreate'], App\Models\User::class)
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.addProduct')}}">Add product</a></li>
                    @endcanany
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewProducts')}}">View product(s)</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewArchivedProducts')}}">View archived product(s)</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#price" data-bs-toggle="collapse" class="sidebar-link collapsed">

                    <i class="align-middle" data-feather="speaker"></i> <span class="align-middle">Price</span>
                </a>

                <ul id="price" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewPrice')}}">View product(s) price</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#supply" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Supply</span>
                </a>
                <ul id="supply" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    @canany(['addSuppliedProductCreate'], App\Models\User::class)
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.addSuppliedProduct')}}">Add supplied product</a></li>
                    @endcanany
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewSuppliedProducts')}}">View supplied product(s)</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewArchivedSuppliedProducts')}}">View archived supplied product(s)</a></li>

                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#sales" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Sales</span>
                </a>
                <ul id="sales" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.salesPos')}}">Manage sales</a></li>


                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#payments" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Payments</span>
                </a>
                <ul id="payments" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    @canany(['viewPayments'], App\Models\User::class)
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.viewPayments')}}">View Payments</a></li>
                    @endcanany

                </ul>
            </li>


        </ul>
        @canany(['salesHistoryReport','getSalesHistoryReport',
        'productsSuppliedReport','getProductsSuppliedReport',
        'paymentsHistoryReport','getPaymentsHistoryReport'], App\Models\User::class)
        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Sales and Payment Report</strong>
                <div class="mb-3 text-sm">
                    Your  sales and payment report is ready for download!
                </div>

                <div class="d-grid">
                    <a href="{{route('admin.reportPage')}}" class="btn btn-outline-primary" role="button">View</a>
                </div>
            </div>
        </div>
        @endcanany
    </div>
</nav>
