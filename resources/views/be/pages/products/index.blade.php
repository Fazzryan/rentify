@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Products - Rentify</title>
    <meta content="Halaman Products Rentify" name="description">
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
                                <h4>Products</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('be.products.add') }}" class="btn btn-primary">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2.2"
                                            d="M15 12h-3m0 0H9m3 0V9m0 3v3M7 3.338A9.95 9.95 0 0 1 12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12c0-1.821.487-3.53 1.338-5" />
                                    </svg>
                                    <span class="ms-1">Add Products</span>
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
                        <table id="ProductsTable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-dark text-start">Image</th>
                                    <th class="text-dark text-start">Name</th>
                                    <th class="text-dark text-start">Category</th>
                                    <th class="text-dark text-start">Brand</th>
                                    <th class="text-dark text-start">Price</th>
                                    <th class="text-dark text-start">Stock</th>
                                    <th class="text-dark">
                                        <div class="d-flex align-items-center text-center">
                                            <iconify-icon icon="solar:settings-broken" width="1.2em"
                                                height="1.2em"></iconify-icon>
                                            <span class="ms-1">Action</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getProducts as $item)
                                    <tr class="align-middle">
                                        <td class="text-dark text-start">
                                            {{-- <img src="../assets/images/be/products/dash-prd-1.jpg" alt="prd1"
                                                width="48" class="rounded"> --}}
                                            @if ($item->firstImage)
                                                <img src="{{ asset('assets/be/images/products/' . '/' . $item->firstImage->image_name) }}"
                                                    alt="{{ $item->name }}" width="60" class="shadow-sm rounded-1"
                                                    style="object-fit: cover;aspect-ratio:1/1;border:1px solid #eee;">
                                            @else
                                                <p>Tidak ada gambar</p>
                                            @endif
                                        </td>
                                        <td class="text-dark text-start">
                                            {!! $item->name !!}
                                        </td>
                                        <td class="text-dark text-start">
                                            {{ $item->category_name }}
                                        </td>
                                        <td class="text-dark text-start">
                                            {{ $item->brand_name }}
                                        </td>
                                        <td class="text-dark text-start">
                                            {{ $item->price }}
                                        </td>
                                        <td class="text-dark text-start">
                                            {{ $item->stock }}
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex align-items-center text-center">
                                                <a type="button"
                                                    class="btn btn-sm btn-success d-flex align-items-center py-2"
                                                    onclick="editProducts({{ $item->id }})">
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
                                                </a>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger d-flex align-items-center ms-1 py-2"
                                                    data-bs-toggle="modal" data-bs-target="#deleteProducts"
                                                    onclick="deleteProducts({{ $item->id }})">
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

    {{-- Modal Delete Products --}}
    <div class="modal fade" tabindex="-1" id="deleteProducts" tabindex="-1" aria-labelledby="deleteProductsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content modal-filled bg-dark">
                <form action="{{ route('be.products.delete_action') }}" method="post">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <h4 class="fw-medium text-white mt-2">Are You Sure?</h4>
                            <p class="mt-3">Data that has been deleted cannot be restored!</p>
                            <form action="" method="post">
                                @csrf
                                <input type="hidden" id="del-product_id" name="product_id" value="">
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
        $('#ProductsTable').DataTable();
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
        function editProducts(id) {
            window.location.replace("{{ route('be.products.edit') }}" + "/" + btoa(id));
        }

        // Delete Kategori
        function deleteProducts(id) {
            $("#del-product_id").val(id);
        }
    </script>
@endpush
