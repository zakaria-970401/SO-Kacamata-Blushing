<!-- LOGO -->
<div class="navbar-brand-box">
    <!-- Dark Logo-->
    <a href="{{ url('/home') }}" class="logo logo-light">
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="22">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" width="190">
        </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
        <i class="ri-record-circle-line"></i>
    </button>
</div>

<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="mdi mdi-database-lock"></i> <span data-key="t-dashboards">DATABASE</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarDashboards">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ url('master/masterUser') }}" class="nav-link" data-key="t-analytics"> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('master/item') }}" class="nav-link" data-key="t-analytics"> Item
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('master/stok') }}" class="nav-link" data-key="t-analytics"> Stok Item

                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('kedatangan') }}">
                    <i class="mdi mdi-shopping"></i> <span data-key="t-widgets">Kedatangan Item</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('pengeluaran') }}">
                    <i class="mdi mdi-exit-to-app"></i> <span data-key="t-widgets">Pengeluaran Item</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#hasil-stokopname" data-bs-toggle="modal">
                    <i class="mdi mdi-file-excel"></i> <span data-key="t-widgets">Hasil Stok Opname</span>
                </a>
            </li>
            @php
                $so = DB::table('master_stokopname')
                ->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();
                @endphp
            @if($so->where('status', 0)->count() > 0 or $so->count() == 0)
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('so/start') }}">
                    <i class="mdi mdi-play"></i> <span data-key="t-widgets">Start Opname</span> 
                </a>
            </li>
            @endif
            @if($so->where('status', 1)->count() > 0)
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('so/stop') }}">
                    <i class="mdi mdi-stop"></i> <span data-key="t-widgets" class="mr-4">Stop Opname</span> <span class="spinner-border flex-shrink-0 ml-4" data-key="t-new"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('so') }}">
                    <i class="mdi mdi-clipboard"></i> <span data-key="t-widgets" class="mr-4">Form Stok Opname</span> 
                </a>
            </li>
            @endif
            <li class="menu-title"><span data-key="t-menu">-----------------------------------</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:void(0)" onclick="logout()">
                    <i class="mdi mdi-logout"></i> <span data-key=""> Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
