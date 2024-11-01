<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                {{-- <img src="{{ asset('assets/be/images/logos/logo.svg') }}" alt="logo" /> --}}
                <span class="text-primary">Rentify</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.dashboard') }}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">TRANSACTION</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('id/transactions/*') ? 'active' : '' }}"
                        href="{{ route('be.transactions') }}" aria-expanded="false">
                        <iconify-icon icon="solar:text-field-focus-line-duotone"></iconify-icon>
                        <span class="hide-menu">Transaction</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">MASTER DATA</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('id/products/*') ? 'active' : '' }}"
                        href="{{ route('be.products') }}" aria-expanded="false">
                        <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.categories') }}" aria-expanded="false">
                        <iconify-icon icon="solar:box-minimalistic-line-duotone"></iconify-icon>
                        <span class="hide-menu">Categories</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.brandscategories') }}" aria-expanded="false">
                        <iconify-icon icon="solar:square-double-alt-arrow-right-linear"></iconify-icon>
                        <span class="hide-menu">Brand Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.brands') }}" aria-expanded="false">
                        <iconify-icon icon="solar:smartphone-rotate-angle-line-duotone"></iconify-icon>
                        <span class="hide-menu">Brands</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.stores') }}" aria-expanded="false">
                        <iconify-icon icon="solar:buildings-2-line-duotone"></iconify-icon>
                        <span class="hide-menu">Stores</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">AUTH</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('be.users') }}" aria-expanded="false">
                        <iconify-icon icon="solar:user-circle-linear"></iconify-icon>
                        <span class="hide-menu">User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('auth.actLogout') }}" aria-expanded="false">
                        <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
