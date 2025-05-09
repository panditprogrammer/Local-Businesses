<!-- Navbar -->

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <form method="GET" action="{{ route('admin.users.index')}}" class="nav-item d-flex align-items-center">
               <button class="btn btn-sm" type="submit">
                <i class="bx bx-search fs-4 lh-0"></i>
               </button>
                <input type="search" name="search" value="{{@$search}}" class="form-control border-0 shadow-none" placeholder="Search people..."
                    aria-label="Search people..." />
            </form>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            {{-- <!-- Place this tag where you want the button to render. -->
            <li class="nav-item lh-1 me-3">
                <a href="#"><i class='menu-icon tf-icons bx bxs-bell-ring'></i></a>
            </li> --}}

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ auth('adminGuard')->user()?->role === "super" ? asset('admin/img/avatars/pawan-jaiswal.png') : asset('assets/images/icons/avatar.png') }}" alt
                            class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ auth('adminGuard')->user()?->role === "super" ? asset('admin/img/avatars/pawan-jaiswal.png') : asset('assets/images/icons/avatar.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ auth('adminGuard')->user()?->name }}</span>
                                    <small class="text-muted"><strong>Role: </strong> {{auth('adminGuard')->user()?->role}} </small>
                                </div>
                            </div>
                        </a>
                    </li>


                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form method="POST" class="dropdown-item" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn w-100 align-middle"><i class="bx bx-power-off me-2"></i>
                                Log Out</button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->
