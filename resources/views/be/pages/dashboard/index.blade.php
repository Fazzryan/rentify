@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Dashboard - Rentify</title>
    <meta content="Halaman Dashboard Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
@endpush
@push('custom-css')
    {{-- <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher.min.css') }}"> --}}
    <style>
        .dashboard-card {
            border: 1.7px solid transparent;
            transition: .3s all;
        }

        .dashboard-card:hover {
            border: 1.7px solid #635BFF;
        }

        /* Spinner Loading Style */
        #loading_spinner {
            display: none;
            /* Spinner tidak terlihat saat awal */
            text-align: center;
            margin: 20px 0;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            /* Warna dasar spinner */
            border-left-color: #3498db;
            /* Warna aktif spinner */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        /* Animasi berputar */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
@push('breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pt-21 pb-md-12">
                    <div class="row">
                        <div class="col-md-4 mt-2 mt-md-0">
                            <nav aria-label="breadcrumb">
                                <h4>Dashboard</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">This is your overview
                                        dashboard for this month</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-8">
                            <form id="search_transaction_form">
                                <div class="row g-2 align-items-end justify-content-end">
                                    <div class="col-12 col-md-4">
                                        <label for="" class="form-label">Start Date</label>
                                        <input type="date" id="add-start_date" name="start_date" class="form-control"
                                            value="{{ $startDate }}">
                                    </div>
                                    <div class="col-12 col-md-4 my-2 my-md-0">
                                        <label for="" class="form-label">End Date</label>
                                        <input type="date" id="add-end_date" name="end_date" class="form-control"
                                            value="{{ $endDate }}">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <button type="button" class="btn btn-primary h-100" style="padding:.7rem;"
                                            onclick="search_transaction()">
                                            <div class="d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                                    viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-width="2.3"
                                                        d="M18.5 18.5L22 22M6.75 3.27a9.5 9.5 0 1 1-3.48 3.48" />
                                                </svg>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@section('content')
    <!-- Animasi Loading -->
    {{-- <div id="loading_spinner">
        <div class="spinner"></div>
        <p>Loading...</p>
    </div> --}}

    <div class="row">
        {{-- Income --}}
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between ">
                        <div>
                            <h6 class="fs-4">Total Income</h6>
                            <h4 class="mb-0">Rp.
                                <span id="total_transaction">
                                    {{ number_format($totalIncome, 0, '.', '.') }}
                                </span>
                            </h4>
                        </div>

                        <span class="round-48 d-flex align-items-center justify-content-center rounded bg-success-subtle">
                            <iconify-icon icon="solar:chat-round-money-linear" class="fs-6 text-success"></iconify-icon>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {{-- Transaction --}}
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="fs-4">Total Transactions</h6>
                            <h4 id="transaction-amount" class="mb-0">
                                {{ number_format($transactionAmount, 0, '.', '.') }}
                            </h4>
                        </div>
                        <span class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
                            <iconify-icon icon="solar:text-field-focus-line-duotone"
                                class="fs-6 text-danger"></iconify-icon>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {{-- Users --}}
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="fs-4">Total Users</h6>
                            <h4 class="mb-0">{{ number_format($userAmount, 0, '.', '.') }}</h4>
                        </div>
                        <span class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                            <iconify-icon icon="solar:user-circle-linear" class="fs-6 text-primary"></iconify-icon>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Product --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="{{ route('be.products') }}">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <div>
                                <h6 class="fs-4">Total Products</h6>
                                <h4 class="mb-0">{{ number_format($productAmount, 0, '.', '.') }}</h4>
                            </div>
                            <span
                                class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"
                                    class="fs-6 text-primary"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {{-- Category --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="#">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <div>
                                <h6 class="fs-4">Total Categories </h6>
                                <h4 class="mb-0">{{ number_format($categoryAmount, 0, '.', '.') }}</h4>
                            </div>
                            <span
                                class="round-48 d-flex align-items-center justify-content-center rounded bg-warning-subtle">
                                <iconify-icon icon="solar:box-minimalistic-broken" class="fs-6 text-warning"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {{-- Store --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="{{ route('be.stores') }}">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <div>
                                <h6 class="fs-4">Total Store</h6>
                                <h4 class="mb-0">{{ number_format($storeAmount, 0, '.', '.') }}</h4>
                            </div>
                            <span
                                class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                                <iconify-icon icon="solar:buildings-2-line-duotone" class="fs-6 text-info"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        {{-- Brand --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <a href="{{ route('be.brands') }}">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="fs-4">Total Brands</h6>
                                <h4 class="mb-0">{{ number_format($brandAmount, 0, '.', '.') }}</h4>
                            </div>
                            <span class="round-48 d-flex align-items-center justify-content-center rounded bg-dark-subtle">
                                <iconify-icon icon="solar:smartphone-rotate-angle-broken"
                                    class="fs-6 text-white"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        {{-- Top Selling Product --}}
        <div class="col-md-9">
            <div class="card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title text-dark fw-semibold mb-4">Top Rent Product</h5>
                    </div>
                    <div class="table-responsive">
                        <table id="TransactionsTable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-dark text-start">Product</th>
                                    <th class="text-dark text-start">Price</th>
                                    <th class="text-dark text-start">Rent</th>
                                    <th class="text-dark text-start">Earning</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topSalesProduct as $item)
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center gap-6">
                                                <img src="{{ asset('assets/be/images/products/' . $item->image_name) }}"
                                                    alt="product" width="48" class="rounded">
                                                <div>
                                                    <h6 class="mb-0">{{ $item->product_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-dark">Rp {{ number_format($item->product_price, 0, '.', '.') }}
                                        </td>
                                        <td class="text-dark">{{ number_format($item->total_rent, 0, '.', '.') }}</td>
                                        <td class="text-dark">Rp {{ number_format($item->earnings, 0, '.', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Categories --}}
        <div class="col-md-3 mt-4 mt-md-0">
            <div class="card mb-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title text-dark fw-semibold mb-4">Top Categories</h5>
                    </div>
                    <div id="top-sales-category">
                        @foreach ($topSalesCategory as $item)
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ asset('assets/be/images/categories/' . $item->logo) }}" alt="category"
                                        width="20" class="me-1">
                                    <span class="text-dark fw-semibold">
                                        {{ $item->name }}
                                    </span>
                                </div>
                                <span class="badge bg-danger-subtle text-danger fw-semibold mt-2">
                                    {{ $item->total_rent }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content modal-filled bg-dark">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <h4 class="fw-medium text-white mt-2">The filter field is reuqired!</h4>
                        <button type="button" class="btn btn-danger rounded-6 my-2"
                            data-bs-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script src="{{ asset('assets/be/libs/chartjs/chart.min.js') }}"></script>
    <script>
        function search_transaction() {
            const startDate = $("#add-start_date").val();
            const endDate = $("#add-end_date").val();

            if (startDate == "" || endDate == "") {
                $("#errorModal").modal("show");
                return;
            }

            var url = "{{ route('api.transactions.search') }}";
            var value = $("#search_transaction_form").serialize();

            // Menampilkan animasi loading
            // $("#loading_spinner").show();
            // $("#search_button").prop('disabled', true); // Optional: Disable tombol selama loading

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'JSON',
                data: value,

                success: function(data) {
                    var result = JSON.parse(JSON.stringify(data));
                    var status = result.status;
                    var msg = result.message;
                    // Menyembunyikan animasi loading setelah request selesai
                    // $("#loading_spinner").hide();

                    if (status == "200") {
                        $("#total_transaction").text(rupiah(result.data.transactionAmount));
                        $("#transaction-amount").text(result.data.transactionCount);

                        $('#TransactionsTable tbody').empty();
                        result.data.topSalesProduct.forEach(function(item) {
                            let row =
                                `<tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center gap-6">
                                        <img src="{{ asset('assets/be/images/products') }}/${item.image_name}" 
                                                alt="product" width="48" class="rounded">
                                            <div>
                                                <h6 class="mb-0">${item.product_name}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-dark">Rp ${rupiah(item.product_price)}</td>
                                    <td class="text-dark">${rupiah(item.total_rent)}</td>
                                    <td class="text-dark">Rp ${rupiah(item.earnings)}</td>
                                </tr>`;
                            // Append baris ke tbody
                            $('#TransactionsTable tbody').append(row);
                        });

                        $('#top-sales-category').empty();
                        result.data.topSalesCategory.forEach(function(item) {
                            let divcategory =
                                `<div class="d-flex justify-content-between align-items-center">
                                    <div>
                                     <img src="{{ asset('assets/be/images/categories') }}/${item.logo}" alt="category"
                                        width="20" class="me-1">
                                          <span class="text-dark fw-semibold">
                                            ${item.name}
                                         </span>
                                    </div>
                                    <span class="badge bg-danger-subtle text-danger fw-semibold mt-1">
                                        ${item.total_rent}
                                    </span>
                                </div>`;
                            $('#top-sales-category').append(divcategory);
                        });
                    } else {
                        console.log(msg);
                    }
                },
                error: function() {
                    console.log(data);
                    // $("#loading_spinner").hide();
                }
            });
        }

        function rupiah(number) {
            const rupiah = new Intl.NumberFormat("id-ID", {
                style: "decimal",
            }).format(number);

            return rupiah;
        }
    </script>

    <script>
        var barColors = [
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
            'rgb(253,193,106)',
        ];

        new Chart("grafik-pendapatan-kotor", {
            type: "bar",
            data: {
                labels: label,
                datasets: [{
                    backgroundColor: barColors,
                    data: value
                }]
            },
            options: {
                animation: false,
                legend: {
                    display: false
                },
                responsive: true,
                title: {
                    display: true,
                    text: ""
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label_tooltips = data.labels[tooltipItem.index];
                            var value = data.datasets[0].data[tooltipItem.index];

                            if (parseInt(value) >= 1000) {
                                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                    ".");
                            } else {
                                return 'Rp ' + value;
                            }
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return 'Rp' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                        ".");
                                } else {
                                    return 'Rp' + value;
                                }
                            }
                        }
                    }]
                }
            }
        });
    </script>
@endpush
