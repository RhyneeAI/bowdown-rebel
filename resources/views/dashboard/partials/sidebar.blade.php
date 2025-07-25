<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/dashboard') }}/images/logos/logo.svg" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route($role.'.dashboard') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route($role.'.product.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:box-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route($role.'.category.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:planet-3-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route($role.'.expedition.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:planet-3-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Ekspedisi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route($role.'.promotion.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:tag-bold-duotone" class="fs-6">
                            </iconify-icon>
                        </span>
                        <span class="hide-menu">Promosi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route($role.'.user.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Data Pengguna</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6" class="fs-6">
                    </iconify-icon>
                    <span class="hide-menu">Transaksi</span>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route($role.'.transaction.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:wallet-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Data Penjualan</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>