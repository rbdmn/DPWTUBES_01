<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('{{ url('images/mountain.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .table thead th {
            background-color: #030303;
            color: #fff;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .badge-pending {
            background-color: #ffc107;
        }

        .badge-confirmed,
        .badge-paid {
            background-color: #28a745;
        }

        .badge-return-requested {
            background-color: #17a2b8;
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background-color: rgba(0, 123, 255, 0.8);
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 style="text-align: center">HALAMAN ADMIN</h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col">Action</th>
                                <th scope="col">Download Bukti PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paidBookings as $booking)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->nama_barang }}</td>
                                <td>Rp {{ number_format($booking->total_harga, 2) }}</td>
                                <td>
                                    @if ($booking->status_submission == 'Pending')
                                    <span class="badge badge-pending">Pending</span>
                                    @elseif ($booking->status_submission == 'Return Requested')
                                    <span class="badge badge-pending">Return Requested</span>
                                    @elseif ($booking->status_submission == 'Returned')
                                    <span class="badge badge-pill badge-info">Returned</span>
                                    @elseif ($booking->status_submission == 'Confirmed')
                                    <span class="badge badge-paid">Confirmed</span>
                                    @elseif ($booking->status_submission == 'Rejected')
                                    <span class="badge badge-pill badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->status_payment == 'Paid')
                                    <span class="badge badge-paid">Paid</span>
                                    @else
                                    <span class="badge badge-pending">Unpaid</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        @if ($booking->status_submission == 'Pending')
                                        <form action="{{ route('admin.confirmSubmission', $booking->id_booking) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Serahkan
                                                Barang</button>
                                        </form>
                                        @elseif ($booking->status_submission == 'Return Requested')
                                        <form action="{{ route('admin.confirmReturn', $booking->id_booking) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Confirm Return</button>
                                        </form>
                                        @elseif ($booking->status_submission == 'Confirmed')
                                        <form action="{{ route('admin.rejectSubmission', $booking->id_booking) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak
                                                Peminjaman</button>
                                        </form>
                                        @elseif ($booking->status_submission == 'Returned')
                                        <span class="text-success">Returned</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if (($booking->status_submission == 'Pending' && $booking->status_payment ==
                                    'Paid'))
                                    <a href="{{ route('bookings.generateSubmissionInvoice', $booking->id_booking) }}"
                                        class="btn btn-info btn-sm">Download Submission Invoice</a>
                                    @elseif ($booking->status_submission == 'Return Requested' &&
                                    $booking->status_payment == 'Paid')
                                    <a href="{{ route('bookings.generateReturnInvoice', $booking->id_booking) }}"
                                        class="btn btn-info btn-sm">Download Return Invoice</a>
                                    @elseif ($booking->status_submission == 'Confirmed' && $booking->status_payment ==
                                    'Paid')
                                    <a href="{{ route('bookings.generateSubmissionInvoice', $booking->id_booking) }}"
                                        class="btn btn-info btn-sm">Download Submission Invoice</a>
                                    @elseif ($booking->status_submission == 'Returned' && $booking->status_payment ==
                                    'Paid')
                                    <a href="{{ route('bookings.generateReturnInvoice', $booking->id_booking) }}"
                                        class="btn btn-info btn-sm">Download Return Invoice</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js"></script>
</body>

</html>