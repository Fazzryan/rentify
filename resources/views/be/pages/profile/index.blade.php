@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Profile - Rentify</title>
    <meta content="Halaman Profile Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
@endpush
@push('breadcrumb')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body pt-3 pb-md-1">
                    <div class="row">
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb">
                                <h4>Profile</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 text-end">
                            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addCategories">
                                <div class="d-flex align-items-center">
                                    <iconify-icon icon="solar:add-circle-broken" class="fs-4"></iconify-icon>
                                    <span class="ms-1">Add Categories</span>
                                </div>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @include('be.layouts.app_session')
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="{{ $getProfile->username }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $getProfile->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" value="{{ $getProfile->pass }}" readonly>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfile"
                        onclick="editProfile({{ $getProfile->id }})">Update
                        Profle</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit profile --}}
    <div class="modal fade" tabindex="-1" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Edit profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('be.profile.edit') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edt-user_id" name="user_id" value="">
                        <div class="mb-3">
                            <label for="edt-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edt-username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="edt-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edt-email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edt-pass" class="form-label">Password</label>
                            <input type="text" class="form-control" id="edt-pass" name="pass" required>
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
@endsection
@push('js')
    <script>
        function editProfile(id) {
            if (id == "{{ $getProfile->id }}") {
                $("#edt-user_id ").val("{{ $getProfile->id }}");
                $("#edt-username ").val("{{ $getProfile->username }}");
                $("#edt-email").val("{{ $getProfile->email }}");
                $("#edt-pass").val("{{ $getProfile->pass }}");
            }
        }
    </script>
@endpush
