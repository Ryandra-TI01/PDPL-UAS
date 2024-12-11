<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading" style="font-weight: bold; color: #007bff;">Dashboard</div>
                <a class="nav-link" href="/dashboard-admin" style="display: flex; align-items: center; transition: background-color 0.3s, color 0.3s;">
                    <span class="material-symbols-outlined" style="margin-right: 10px;">
                        dashboard
                    </span>
                     Dashboard
                </a>
                <div class="sb-sidenav-menu-heading" style="font-weight: bold; color: #007bff;">Kamar</div>
                <a class="nav-link" href="{{ route('admin.tipe_kamar') }}" style="display: flex; align-items: center; transition: background-color 0.3s, color 0.3s;">
                    <span class="material-symbols-outlined" style="margin-right: 10px;">
                        single_bed
                    </span>
                    Tipe Kamar
                </a>
                <a class="nav-link" href="{{ route('admin.kamar') }}" style="display: flex; align-items: center; transition: background-color 0.3s, color 0.3s;">
                    <span class="material-symbols-outlined" style="margin-right: 10px;">
                        king_bed
                    </span>                    
                    Kamar
                </a>
                <div class="sb-sidenav-menu-heading" style="font-weight: bold; color: #007bff;">User</div>
                <a class="nav-link" href="{{ route('admin.user') }}" style="display: flex; align-items: center; transition: background-color 0.3s, color 0.3s;">
                    <span class="material-symbols-outlined" style="margin-right: 10px;">
                        group
                    </span>
                    User
                </a>
                <a class="nav-link" href="{{ route('admin.pemesanan') }}" style="display: flex; align-items: center; transition: background-color 0.3s, color 0.3s;">
                    <span class="material-symbols-outlined" style="margin-right: 10px;">
                        home
                    </span>
                    Pemesanan
                </a>
                <div class="sb-sidenav-menu-heading" style="font-weight: bold; color: #007bff;">Dashboard User</div>
                <a class="nav-link" href="/dashboard" style="display: flex; align-items: center; transition: background-color 0.3s, color 0.3s;">
                    <span class="material-symbols-outlined" style="margin-right: 10px;">
                        home
                    </span>
                    Home
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer" style="background-color: #f8f9fa; padding: 20px; text-align: center;">
            <div class="small" style="font-weight: bold;">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
