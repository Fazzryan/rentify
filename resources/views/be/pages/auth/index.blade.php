@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Users - Rentify</title>
    <meta content="Halaman Users Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
@endpush
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/be/css/datatables.min.css') }}" />
@endpush
@push('breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pt-3 pb-md-1">
                    <div class="row">
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb">
                                <h4>Users</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUsers">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2.2"
                                            d="M15 12h-3m0 0H9m3 0V9m0 3v3M7 3.338A9.95 9.95 0 0 1 12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12c0-1.821.487-3.53 1.338-5" />
                                    </svg>
                                    <span class="ms-1">Add Users</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('be.layouts.app_session')
                    <div class="table-responsive">
                        <table id="UsersTable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-dark text-start">#</th>
                                    <th class="text-dark text-start">Username</th>
                                    <th class="text-dark text-start">Email</th>
                                    <th class="text-dark text-start">Role</th>
                                    {{-- <th class="text-dark">
                                        <div class="d-flex align-items-center  text-center">
                                            <iconify-icon icon="solar:settings-broken" width="1.2em"
                                                height="1.2em"></iconify-icon>
                                            <span class="ms-1">Action</span>
                                        </div>
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getUsers as $key => $item)
                                    <tr class="align-middle">
                                        <td class="text-start">{{ $key + 1 }}</td>
                                        <td class="text-dark text-start">
                                            {{ $item->username }}
                                        </td>
                                        <td class="text-dark text-start">
                                            {{ $item->email }}
                                        </td>
                                        <td class="text-dark text-start">
                                            @if ($item->role == 'owner')
                                                <span
                                                    class="badge bg-primary-subtle text-primary fw-bolder text-capitalize">{{ $item->role }}</span>
                                            @elseif($item->role == 'admin')
                                                <span
                                                    class="badge bg-danger-subtle text-danger fw-bolder text-capitalize">{{ $item->role }}</span>
                                            @elseif($item->role == 'user')
                                                <span
                                                    class="badge bg-success-subtle text-success fw-bolder text-capitalize">{{ $item->role }}</span>
                                            @endif
                                        </td>
                                        {{-- <td class="text-end">
                                            <div class="d-flex align-items-center text-center">
                                                <button type="button"
                                                    class="btn btn-sm btn-success d-flex align-items-center py-2"
                                                    data-bs-toggle="modal" data-bs-target="#editUsers"
                                                    onclick="editUsers({{ $item->id }})">
                                                    <iconify-icon icon="solar:pen-new-round-linear" class="fw-bold"
                                                        width="1.2em" height="1.2em"></iconify-icon>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger d-flex align-items-center ms-1 py-2"
                                                    data-bs-toggle="modal" data-bs-target="#deleteUsers"
                                                    onclick="deleteUsers({{ $item->id }})">
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-broken" class="fw-bold"
                                                        width="1.2em" height="1.2em"></iconify-icon>
                                                </button>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit Users --}}
    <div class="modal fade" tabindex="-1" id="addUsers" tabindex="-1" aria-labelledby="addUsersLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Add Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('be.users.act_add_account') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="add-username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="add-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="add-email" name="email">
                        </div>
                        <label for="add-password" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="add-password" name="password">
                            <button class="btn btn-light d-flex align-items-center" type="button" id="btn-show-hide"
                                onclick="showHidePass()">
                                <iconify-icon icon="solar:eye-broken" width="1.2em" height="1.2em" class="d-block"
                                    id="show-icon"></iconify-icon>
                                <iconify-icon icon="solar:eye-closed-broken" width="1.2em" height="1.2em"
                                    class="d-none" id="hide-icon"></iconify-icon>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label for="add-role" class="form-label">Role</label>
                            <select id="add-role" name="role" class="form-select">
                                <option value="owner">Owner</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Users --}}
    {{-- <div class="modal fade" tabindex="-1" id="editUsers" tabindex="-1" aria-labelledby="editUsersLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Edit Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edt-user_id" name="user_id" value="">
                        <div class="mb-3">
                            <label for="edt-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edt-username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="edt-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edt-email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="edt-role" class="form-label">Role</label>
                            <select id="edt-role" name="role" class="form-select">
                                <option value="owner">Owner</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@push('js')
    <script src="{{ asset('assets/be/js/datatables.min.js') }}"></script>

    <script>
        $('#UsersTable').DataTable();
    </script>
    <script>
        function showHidePass() {
            var $password = $("#add-password");
            var $hideIcon = $("#hide-icon");
            var $showIcon = $("#show-icon");

            var isPassword = $password.attr("type") === "password";

            $password.attr("type", isPassword ? "text" : "password");

            $hideIcon.toggleClass("d-none d-block", !isPassword); // !isPassword -> isPassword == false
            $showIcon.toggleClass("d-none d-block", isPassword); // isPassword -> isPassword == true
        }
        // Edit Kategori
        // function editUsers(id) {
        //     @foreach ($getUsers as $val)
        //         if (id == "{{ $val->id }}") {
        //             $("#edt-user_id ").val("{{ $val->id }}");
        //             $("#edt-username ").val("{{ $val->username }}");
        //             $("#edt-email ").val("{{ $val->email }}");
        //             $("#edt-role ").val("{{ $val->role }}");
        //         }
        //     @endforeach
        // }
    </script>
@endpush
