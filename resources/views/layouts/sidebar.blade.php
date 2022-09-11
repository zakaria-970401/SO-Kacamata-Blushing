@php
$permission = DB::table('auth_group_permission')
    ->join('auth_permission', 'auth_permission.id', '=', 'auth_group_permission.permission_id')
    ->where('auth_group_permission.group_id', Auth::user()->auth_group)
    ->pluck('auth_permission.name')
    ->toArray();
@endphp
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
            @if(in_array('database-header', $permission))
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="mdi mdi-database-lock"></i> <span data-key="t-dashboards">DATABASE</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarDashboards">
                    <ul class="nav nav-sm flex-column">
                        @if(in_array('master-user', $permission))
                        <li class="nav-item">
                            <a href="{{ url('master/masterUser') }}" class="nav-link" data-key="t-analytics"> Users
                            </a>
                        </li>
                        @endif
                        @if(in_array('master-item', $permission))
                        <li class="nav-item">
                            <a href="{{ url('master/item') }}" class="nav-link" data-key="t-analytics"> Item
                            </a>
                        </li>
                        @endif
                        @if(in_array('master-stok', $permission))
                        <li class="nav-item">
                            <a href="{{ url('master/stok') }}" class="nav-link" data-key="t-analytics"> Stok Item
                                
                            </a>
                        </li>
                        @endif
                        @if(in_array('master-menu', $permission))
                        <li class="nav-item">
                            <a href="{{ url('permission') }}" class="nav-link" data-key="t-analytics"> Manage Menu
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
            @if(in_array('kedatangan-item', $permission))
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('kedatangan') }}">
                    <i class="mdi mdi-shopping"></i> <span data-key="t-widgets">Kedatangan Item</span>
                </a>
            </li>
            @endif
            @if(in_array('pengeluaran-item', $permission))
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('pengeluaran') }}">
                    <i class="mdi mdi-exit-to-app"></i> <span data-key="t-widgets">Pengeluaran Item</span>
                </a>
            </li>
            @endif
            @if(in_array('hasil-opname', $permission))
            <li class="nav-item">
                <a class="nav-link menu-link" href="#hasil-stokopname" data-bs-toggle="modal">
                    <i class="mdi mdi-file-excel"></i> <span data-key="t-widgets">Hasil Stok Opname</span>
                </a>
            </li>
            @endif
            @php
                $so = DB::table('master_stokopname')
                ->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();
            @endphp
            @if(in_array('start-opname', $permission))
                @if($so->where('status', 0)->count() > 0 or $so->count() == 0)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('so/start') }}">
                        <i class="mdi mdi-play"></i> <span data-key="t-widgets">Start Opname</span> 
                    </a>
                </li>
                @endif
            @endif
            @if(in_array('stop-opname', $permission) and $so->where('status', 1)->count() > 0 )
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('so/stop') }}">
                        <i class="mdi mdi-stop"></i> <span data-key="t-widgets" class="mr-4">Stop Opname</span> <span class="spinner-border flex-shrink-0 ml-4" data-key="t-new"></span>
                    </a>
                </li>
            @endif
            @if(in_array('form-stok-opname', $permission) and $so->where('status', 1)->count() > 0)
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('so') }}">
                    <i class="mdi mdi-clipboard"></i> <span data-key="t-widgets" class="mr-4">Form Stok Opname</span> 
                </a>
            </li>
            @endif
            @if(in_array('report', $permission))
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ url('report') }}">
                    <i class="mdi mdi-chart-histogram"></i> <span data-key="t-widgets" class="mr-4">Report</span> 
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
