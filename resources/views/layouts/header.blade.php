<div class="navbar-header">
    <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box horizontal-logo">
            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="35">
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none"
            id="topnav-hamburger-icon">
            <span class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>

        <!-- App Search-->
        <form class="app-search d-none d-md-block">
            <div class="position-relative">
                <span class="badge badge-outline-primary mt-2 time" style="zoom: 140%;"></span>
                <input type="hidden" class="form-control" placeholder="Search..." autocomplete="off"
                    id="search-options" value="">
                {{-- <span class="mdi mdi-magnify search-widget-icon"></span> --}}
                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                    id="search-close-options"></span>
            </div>
            <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                <div data-simplebar style="max-height: 320px;">
                    <!-- item-->
                    <div class="dropdown-header">
                        <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                    </div>

                    <div class="dropdown-item bg-transparent text-wrap">
                        <a href="index.html" class="btn btn-soft-secondary btn-sm btn-rounded">how to setup <i
                                class="mdi mdi-magnify ms-1"></i></a>
                        <a href="index.html" class="btn btn-soft-secondary btn-sm btn-rounded">buttons <i
                                class="mdi mdi-magnify ms-1"></i></a>
                    </div>
                    <!-- item-->
                    <div class="dropdown-header mt-2">
                        <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                        <span>Analytics Dashboard</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                        <span>Help Center</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                        <span>My account settings</span>
                    </a>

                    <!-- item-->
                    <div class="dropdown-header mt-2">
                        <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                    </div>

                </div>

                <div class="text-center pt-3 pb-1">
                    <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i
                            class="ri-arrow-right-line ms-1"></i></a>
                </div>
            </div>
        </form>
    </div>

    <div class="d-flex align-items-center">

        <div class="dropdown d-md-none topbar-head-dropdown header-item">
            <span class="badge badge-outline-primary time" style="zoom: 130%;"></span>
        </div>

        <div class="dropdown ms-1 topbar-head-dropdown header-item">

        </div>

        <div class="dropdown topbar-head-dropdown ms-1 header-item">

        </div>

        <div class="dropdown topbar-head-dropdown ms-1 header-item">
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart"
                aria-labelledby="page-header-cart-dropdown">
            </div>
        </div>

        <div class="ms-1 header-item d-none d-sm-flex">
            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                data-toggle="fullscreen">
                <i class='bx bx-fullscreen fs-22'></i>
            </button>
        </div>


        <div class="dropdown ms-sm-3 header-item topbar-user">
            <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="d-flex align-items-center">
                    <img class="rounded-circle header-profile-user" src="{{ asset('/assets/images/user-blank.jpg') }}"
                        alt="Header Avatar">
                    <span class="text-start ms-xl-2">
                        <span
                            class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">
                            @if (Auth::user()->auth_group == 1)
                                Super Admin
                            @elseif (Auth::user()->auth_group == 2)
                                Data Entry
                            @else
                                Manager
                            @endif
                        </span>
                    </span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}</h6>
                <a class="dropdown-item" href="#ganti-pw" data-bs-toggle="modal"><i
                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                        class="align-middle">Change Password</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)" onclick="logout()"><i
                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                        data-key="t-logout">Logout</span></a>
            </div>
        </div>
    </div>
</div>
