<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Font Awesome -->

    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" /> --}}
    <!-- Google Fonts -->
    {{--
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" /> --}}
    <!-- MDB -->
    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet" /> --}}

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('admin_dashboard/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('admin_dashboard/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('admin_dashboard/css/style.css')}}" rel="stylesheet">

    <!--begin::Fonts(mandatory for all pages)-->
    {{--
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> --}}
    <!--end::Fonts-->
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="{{route('admin.home')}}" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>RENTALBOSS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{asset('images/admin.jpg')}}" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Mas Admin</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a id="homeLink" href="{{route('admin.home')}}" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Data Persetujuan</a>
                    <a id="keuanganLink" href="{{route('admin.keuangan')}}" class="nav-item nav-link"><i
                            class="fa fa-th me-2"></i>Data Keuangan</a>
                    <a id="pelangganLink" href="{{route('admin.pelanggan')}}" class="nav-item nav-link"><i
                            class="fa fa-table me-2"></i>Data Pelanggan</a>
                    <a id="transaksiLink" href="{{route('admin.transaksi')}}" class="nav-item nav-link"><i
                            class="fa fa-chart-bar me-2"></i>Data Transaksi</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                {{-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form> --}}
                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{asset('images/admin.jpg')}}" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Booking Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Persetujuan</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-light text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Batas Waktu</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Pembayaran</th>
                                    <th scope="col">Aksi</th>
                                    <th scope="col">Bukti Pembayaran</th> <!-- Tambahkan kolom ini -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Status_Bookingnya as $booking)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->nama_barang }}</td>
                                    <td>Rp {{ number_format($booking->total_harga, 2) }}</td>
                                    <td>
                                        @if ($booking->due_date)
                                        {{ \Carbon\Carbon::parse($booking->due_date)->format('d-m-Y H:i') }}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($booking->status_submission == 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($booking->status_submission == 'Permintaan Pengembalian')
                                        <span class="badge bg-warning text-dark">Permohonan kembalikan barang</span>
                                        @elseif ($booking->status_submission == 'Telah Dikembalikan')
                                        <span class="badge bg-success">Barang telah dikembalikan</span>
                                        @elseif ($booking->status_submission == 'Sah')
                                        <span class="badge bg-info">Barang telah diserahkan</span>
                                        @elseif ($booking->status_submission == 'Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($booking->status_payment == 'Terbayar')
                                        <span class="badge bg-success">Sudah bayar</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Belum bayar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-inline-flex">
                                            @if ($booking->status_submission == 'Pending')
                                            <form action="{{ route('admin.confirmSubmission', $booking->id_booking) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm me-2">Serahkan
                                                    Barang</button>
                                            </form>
                                            <form action="{{ route('admin.rejectSubmission', $booking->id_booking) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Tolak
                                                    Peminjaman</button>
                                            </form>
                                            @elseif ($booking->status_submission == 'Permintaan Pengembalian')
                                            <form action="{{ route('admin.confirmReturn', $booking->id_booking) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Konfirm
                                                    Pengembalian</button>
                                            </form>
                                            @elseif ($booking->status_submission == 'Sah')
                                            <span class="text-info">Barang telah diserahkan</span>
                                            @elseif ($booking->status_submission =='Telah Dikembalikan')
                                            <span class="text-success">Barang telah dikembalikan</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ url('bukti_pembayaran/' . $booking->bukti_pembayaran) }}"
                                            target="_blank" class="btn btn-info btn-sm">Lihat Bukti Pembayaran</a>
                                        @if ($booking->status_submission == 'Permintaan Pengembalian')
                                        <a href="{{ route('bookings.MembuatFakturBuktiPengembalianDariUserKeAdmin', $booking->id_booking) }}"
                                            class="btn btn-info btn-sm">Download Bukti Pengembalian</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Booking End -->





            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="{{route('admin.home')}}">RENTALBOSS</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin_dashboard/lib/chart/chart.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/lib/tempusdominus/js/moment-timezone.min.jss')}}"></script>
    <script src="{{asset('admin_dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('admin_dashboard/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js">
    </script>

</body>

</html>