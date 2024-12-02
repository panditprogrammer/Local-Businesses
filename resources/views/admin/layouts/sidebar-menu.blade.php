<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img width="30px" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder text-capitalize ms-2">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Route::currentRouteName() == 'admin.dashboard.index' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @if (auth('adminGuard')?->user()?->role === 'super')
            <li class="menu-item {{ Route::currentRouteName() == 'admin.messages.index' ? 'active' : '' }}">
                <a href="{{ route('admin.messages.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-detail"></i>
                    <div data-i18n="Analytics">Contact Messages</div>
                </a>
            </li>


            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text"> Manage </span></li>

            <li class="menu-item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-table"></i>
                    <div data-i18n="Tables">Post Category</div>
                </a>
            </li>
            <li class="menu-item {{ Route::currentRouteName() == 'admin.posts.index' ? 'active' : '' }}">
                <a href="{{ route('admin.posts.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-table"></i>
                    <div data-i18n="Tables">Post</div>
                </a>
            </li>

          
            <li class="menu-item {{ Route::currentRouteName() == 'admin.sliders.index' ? 'active' : '' }}">
                <a href="{{ route('admin.sliders.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-table"></i>
                    <div data-i18n="Tables">Homepage Sliders</div>
                </a>
            </li>


            <li class="menu-item {{ Route::currentRouteName() == 'admin.newsletters.index' ? 'active' : '' }}">
                <a href="{{ route('admin.newsletters.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-table"></i>
                    <div data-i18n="Tables">Subscribers & News Letters</div>
                </a>
            </li>


            <li class="menu-item {{ Route::currentRouteName() == 'admin.admins.index' ? 'active' : '' }}">
                <a href="{{ route('admin.admins.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-table"></i>
                    <div data-i18n="Tables">Manage Admins</div>
                </a>
            </li>
        @endif


        <li class="menu-item {{ Route::currentRouteName() == 'admin.users.index' ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">Public Registrations</div>
            </a>
        </li>


        <li class="menu-item {{ Route::currentRouteName() == 'admin.app-release.index' ? 'active' : '' }}">
            <a href="{{ route('admin.app-release.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">App Release</div>
            </a>
        </li>


        @if (auth('adminGuard')?->user()?->role === 'super')
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Settings</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Account Settings">General Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    {{-- <a href="{{ route('admin.setting.account.index') }}" class="menu-link">
                        <div data-i18n="Account">Account</div>
                    </a> --}}
                    <a href="{{ route('admin.setting.clearCache') }}" class="menu-link">
                        <div data-i18n="cache-clear">Clear Cache</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</aside>
<!-- / Menu -->
