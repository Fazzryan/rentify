@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Stores - Rentify</title>
    <meta content="Halaman Stores Rentify" name="description">
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
                                <h4>Stores</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Stores</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStores">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2.2"
                                            d="M15 12h-3m0 0H9m3 0V9m0 3v3M7 3.338A9.95 9.95 0 0 1 12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12c0-1.821.487-3.53 1.338-5" />
                                    </svg>
                                    <span class="ms-1">Add Stores</span>
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
                        <table id="StoresTable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-dark text-start">#</th>
                                    <th class="text-dark text-start">Stores Name</th>
                                    <th class="text-dark text-start">Address</th>
                                    <th class="text-dark text-start">Status</th>
                                    <th class="text-dark">
                                        <div class="d-flex align-items-center  text-center">
                                            <iconify-icon icon="solar:settings-broken" width="1.2em"
                                                height="1.2em"></iconify-icon>
                                            <span class="ms-1">Action</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getStores as $key => $item)
                                    <tr class="align-middle">
                                        <td class="text-start">{{ $key + 1 }}</td>
                                        <td class="text-dark text-start">
                                            {{ $item->name }}
                                        </td>
                                        <td class="text-dark text-start">
                                            {!! $item->address !!}
                                        </td>
                                        <td class="text-dark text-start">
                                            @if ($item->is_open == 1)
                                                <span class="badge bg-success-subtle text-success">Open</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">Close</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex align-items-center text-center">
                                                <button type="button"
                                                    class="btn btn-sm btn-success d-flex align-items-center py-2"
                                                    data-bs-toggle="modal" data-bs-target="#editStores"
                                                    onclick="editStores({{ $item->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                                        viewBox="0 0 24 24">
                                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="2.2">
                                                            <path
                                                                d="M2 12c0 4.714 0 7.071 1.464 8.535C4.93 22 7.286 22 12 22s7.071 0 8.535-1.465C22 19.072 22 16.714 22 12v-1.5M13.5 2H12C7.286 2 4.929 2 3.464 3.464c-.973.974-1.3 2.343-1.409 4.536" />
                                                            <path
                                                                d="m16.652 3.455l.649-.649A2.753 2.753 0 0 1 21.194 6.7l-.65.649m-3.892-3.893s.081 1.379 1.298 2.595c1.216 1.217 2.595 1.298 2.595 1.298m-3.893-3.893L10.687 9.42c-.404.404-.606.606-.78.829q-.308.395-.524.848c-.121.255-.211.526-.392 1.068L8.412 13.9m12.133-6.552l-2.983 2.982m-2.982 2.983c-.404.404-.606.606-.829.78a4.6 4.6 0 0 1-.848.524c-.255.121-.526.211-1.068.392l-1.735.579m0 0l-1.123.374a.742.742 0 0 1-.939-.94l.374-1.122m1.688 1.688L8.412 13.9" />
                                                        </g>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger d-flex align-items-center ms-1 py-2"
                                                    data-bs-toggle="modal" data-bs-target="#deleteStores"
                                                    onclick="deleteStores({{ $item->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                                        viewBox="0 0 24 24">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="2.2"
                                                            d="M20.5 6h-17m5.67-2a3.001 3.001 0 0 1 5.66 0m3.544 11.4c-.177 2.654-.266 3.981-1.131 4.79s-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9m13.666 0l-.2 3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Add Stores --}}
    <div class="modal fade" tabindex="-1" id="addStores" tabindex="-1" aria-labelledby="AddStoresLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Add New Stores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('be.stores.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="add-name" name="name"
                                aria-describedby="add-name">
                        </div>
                        <div class="mb-3 d-none">
                            <label for="add-slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="add-slug" name="slug"
                                aria-describedby="add-slug" readonly>
                            <div class="form-text">Slug will be filled in automatically</div>
                        </div>
                        <div class="mb-3">
                            <label for="add-address" class="form-label">Address</label>
                            <textarea name="address" id="add-address" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="add-is_open" class="form-label">Status</label>
                            <select id="add-is_open" name="is_open" class="form-select">
                                <option value="1">Open</option>
                                <option value="0">Close</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Stores --}}
    <div class="modal fade" tabindex="-1" id="editStores" tabindex="-1" aria-labelledby="editStoresLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Edit Stores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('be.stores.edit') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edt-store_id" name="store_id" value="">
                        <div class="mb-3">
                            <label for="edt-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edt-name" name="name"
                                aria-describedby="edt-name">
                        </div>
                        <div class="mb-3 d-none">
                            <label for="edt-slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="edt-slug" name="slug"
                                aria-describedby="edt-slug" readonly>
                            <div class="form-text">Slug will be filled in automatically</div>
                        </div>
                        <div class="mb-3">
                            <label for="edt-address" class="form-label">Address</label>
                            <textarea name="address" id="edt-address" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edt-is_open" class="form-label">Status</label>
                            <select id="edt-is_open" name="is_open" class="form-select">
                                <option value="1">Open</option>
                                <option value="0">Close</option>
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

    {{-- Modal Delete Stores --}}
    <div class="modal fade" tabindex="-1" id="deleteStores" tabindex="-1" aria-labelledby="deleteStoresLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content modal-filled bg-dark">
                <form action="{{ route('be.stores.delete') }}" method="post">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <h4 class="fw-medium text-white mt-2">Are You Sure?</h4>
                            <p class="mt-3">Data that has been deleted cannot be restored!</p>
                            <form action="{{ route('be.stores.delete') }}" method="post">
                                @csrf
                                <input type="hidden" id="del-store_id" name="store_id" value="">
                                <button type="button" class="btn btn-light rounded-6 my-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger rounded-6 my-2 ms-1"
                                    data-bs-dismiss="modal">Delete</button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/be/js/datatables.min.js') }}"></script>

    <script>
        $('#StoresTable').DataTable();
    </script>

    <script>
        getSlug('#add-name', '#add-slug');
        getSlug('#edt-name', '#edt-slug');
        // Membuat Slug
        function getSlug(input, output) {
            $(input).keyup(function() {
                var nm_input = $(input).val();
                var lower = nm_input.replace(/\s+/g, '-').toLowerCase();;
                $(output).val(lower);
            });
        }

        // Edit Kategori
        function editStores(id) {
            @foreach ($getStores as $val)
                if (id == "{{ $val->id }}") {
                    $("#edt-store_id ").val("{{ $val->id }}");
                    $("#edt-name ").val("{{ $val->name }}");
                    $("#edt-slug ").val("{{ $val->slug }}");
                    $("#edt-address ").val("{{ $val->address }}");
                    $("#edt-is_open ").val("{{ $val->is_open }}");
                }
            @endforeach
        }

        // Delete Kategori
        function deleteStores(id) {
            $("#del-store_id").val(id);
        }
    </script>
@endpush
