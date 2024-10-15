<nav class="navbar navbar-expand-lg bg-white fixed-bottom nav-bottom">
    <div class="container d-block border-top text-center pt-3" style="max-width: 768px;">
        <div class="row justify-content-between">
            <div class="col col-md-3">
                <a href="{{ route('fe.beranda') }}" class="nav-bottom-item {{ request()->is('/') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                            <path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1" />
                            <path
                                d="M22 12.204v1.521c0 3.9 0 5.851-1.172 7.063S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.212S2 17.626 2 13.725v-1.521c0-2.289 0-3.433.52-4.381c.518-.949 1.467-1.537 3.364-2.715l2-1.241C9.889 2.622 10.892 2 12 2s2.11.622 4.116 1.867l2 1.241c1.897 1.178 2.846 1.766 3.365 2.715" />
                        </g>
                    </svg>
                    <div class="mt-1">Browse</div>
                </a>
            </div>
            <div class="col col-md-3">
                <a href="{{ route('fe.orders') }}"
                    class="nav-bottom-item {{ request()->is('orders') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <g fill="none">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="M6 14.5h8M6 18h5.5" />
                            <path stroke="currentColor" stroke-width="2"
                                d="M13 2.5V5c0 2.357 0 3.536.732 4.268S15.643 10 18 10h4" />
                            <path fill="currentColor"
                                d="M2.75 10a.75.75 0 0 0-1.5 0zm18.5 4a.75.75 0 0 0 1.5 0zm-5.857-9.946l-.502.557zm3.959 3.563l-.502.557zm2.302 2.537l-.685.305zM3.172 20.828l.53-.53zm17.656 0l-.53-.53zM1.355 5.927a.75.75 0 0 0 1.493.146zm21.29 12.146a.75.75 0 1 0-1.493-.146zM14 21.25h-4v1.5h4zM2.75 14v-4h-1.5v4zm18.5-.437V14h1.5v-.437zM14.891 4.61l3.959 3.563l1.003-1.115l-3.958-3.563zm7.859 8.952c0-1.689.015-2.758-.41-3.714l-1.371.61c.266.598.281 1.283.281 3.104zm-3.9-5.389c1.353 1.218 1.853 1.688 2.119 2.285l1.37-.61c-.426-.957-1.23-1.66-2.486-2.79zM10.03 2.75c1.582 0 2.179.012 2.71.216l.538-1.4c-.852-.328-1.78-.316-3.248-.316zm5.865.746c-1.086-.977-1.765-1.604-2.617-1.93l-.537 1.4c.532.204.98.592 2.15 1.645zM10 21.25c-1.907 0-3.261-.002-4.29-.14c-1.005-.135-1.585-.389-2.008-.812l-1.06 1.06c.748.75 1.697 1.081 2.869 1.239c1.15.155 2.625.153 4.489.153zM1.25 14c0 1.864-.002 3.338.153 4.489c.158 1.172.49 2.121 1.238 2.87l1.06-1.06c-.422-.424-.676-1.004-.811-2.01c-.138-1.027-.14-2.382-.14-4.289zM14 22.75c1.864 0 3.338.002 4.489-.153c1.172-.158 2.121-.49 2.87-1.238l-1.06-1.06c-.424.422-1.004.676-2.01.811c-1.027.138-2.382.14-4.289.14zm-3.97-21.5c-1.875 0-3.356-.002-4.511.153c-1.177.158-2.129.49-2.878 1.238l1.06 1.06c.424-.422 1.005-.676 2.017-.811c1.033-.138 2.395-.14 4.312-.14zM2.848 6.073c.121-1.234.382-1.9.854-2.371l-1.06-1.06c-.836.834-1.153 1.919-1.287 3.285zm18.304 11.854c-.121 1.234-.383 1.9-.854 2.371l1.06 1.06c.836-.834 1.153-1.919 1.287-3.285z" />
                        </g>
                    </svg>
                    <div class="mt-1">Orders</div>
                </a>
            </div>
            <div class="col col-md-3">
                <a href="{{ route('fe.contact') }}"
                    class="nav-bottom-item {{ request()->is('contact') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" d="M7 18h5.5" />
                            <path
                                d="M8 3.5A1.5 1.5 0 0 1 9.5 2h5A1.5 1.5 0 0 1 16 3.5v1A1.5 1.5 0 0 1 14.5 6h-5A1.5 1.5 0 0 1 8 4.5z" />
                            <path stroke-linecap="round"
                                d="M21 16c0 2.829 0 4.243-.879 5.122C19.243 22 17.828 22 15 22H9c-2.828 0-4.243 0-5.121-.878C3 20.242 3 18.829 3 16v-3m13-8.998c2.175.012 3.353.109 4.121.877C21 5.758 21 7.172 21 10v2M8 4.002c-2.175.012-3.353.109-4.121.877S3.014 6.825 3.002 9M7 14.5h1m7 0h-4" />
                        </g>
                    </svg>
                    <div class="mt-1">Contact</div>
                </a>
            </div>
            <div class="col col-md-3">
                @if (Session::has('login'))
                    <a href="{{ route('fe.account') }}"
                        class="nav-bottom-item {{ request()->is('user/account') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="6" r="4" />
                                <ellipse cx="12" cy="17" rx="7" ry="4" />
                            </g>
                        </svg>
                        <div class="mt-1">Account</div>
                    </a>
                @else
                    <a href="{{ route('auth.login') }}" class="nav-bottom-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                                <path
                                    d="M8 16c0 2.828 0 4.243.879 5.121c.641.642 1.568.815 3.121.862M8 8c0-2.828 0-4.243.879-5.121C9.757 2 11.172 2 14 2h1c2.828 0 4.243 0 5.121.879C21 3.757 21 5.172 21 8v8c0 2.828 0 4.243-.879 5.121c-.768.769-1.946.865-4.121.877M3 9.5v5c0 2.357 0 3.535.732 4.268S5.643 19.5 8 19.5M3.732 5.232C4.464 4.5 5.643 4.5 8 4.5" />
                                <path stroke-linejoin="round" d="M6 12h9m0 0l-2.5 2.5M15 12l-2.5-2.5" />
                            </g>
                        </svg>
                        <div class="mt-1">Sign In </div>
                    </a>
                @endif

            </div>
        </div>
        {{-- <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row mx-auto align-items-center justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">
                        Beranda
                    </a>
                </li>
            </ul>
        </div> --}}
    </div>
</nav>