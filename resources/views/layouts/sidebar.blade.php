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
                            <a href="{{ url('master/item') }}" class="nav-link" data-key="t-analytics"> Item Material
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('master/stok') }}" class="nav-link" data-key="t-analytics"> Stok Item
                                Material
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:void(0)">
                    <i class="mdi mdi-shopping"></i> <span data-key="t-widgets">Kedatangan Item Material</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="javascript:void(0)">
                    <i class="mdi mdi-clipboard-list"></i> <span data-key="t-widgets">Permintaan Revisi Stok
                        Opname</span> <span class="badge badge-pill bg-danger" data-key="t-new">23</span>
                </a>
            </li>
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
