<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav align-items-center w-100">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <h6 class="text-dark fw-bold mb-0">
                    @if (Session::get('user_session')['role'] == 'owner')
                        Hello owner,
                    @else
                        Hello,
                    @endif
                    <span class="text-capitalize">{{ Session::get('user_session')['username'] }}</span>
                </h6>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link " href="javascript:void(0)">
                    <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li> --}}
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('assets/be/images/profile/user-1.jpg') }}" alt="" width="35"
                            height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="{{ route('be.profile') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>

                            <a href="{{ route('fe.beranda') }}" class="d-flex align-items-center gap-2 dropdown-item"
                                target="_blank">
                                <i class="ti ti-home fs-6"></i>
                                <p class="mb-0 fs-3">Beranda</p>
                            </a>

                            <a href="{{ route('auth.actLogout') }}"
                                class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
