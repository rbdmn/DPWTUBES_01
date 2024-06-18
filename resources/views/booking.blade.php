<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet" />
    <style>
        /* Custom background color */
        body {
            background-color: #f8f9fa;
            background-image: url('{{ url('images/scenerynight.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Add this line */
            height: 100vh;
            margin: 0;
        }

        /* Table styles */
        .table thead th {
            background-color: #030303;
            /* Dark background for table headers */
            color: #fff;
            /* White text color for table headers */
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            /* Light background color on hover */
        }

        /* Badge colors */
        .badge-pending {
            background-color: #ffc107;
            /* Yellow color for pending status */
        }

        .badge-Sah,
        .badge-Terbayar {
            background-color: #28a745;
            /* Green color for Sah and Terbayar status */
        }

        .badge-return-requested {
            background-color: #17a2b8;
            /* Light blue color for Permintaan Pengembalian status */
        }

        /* Action buttons */
        .table-actions .btn {
            color: #fff;
            /* White text color for buttons */
        }

        /* Modal background */
        .modal-content {
            background-color: #1b2f34;
            /* Dark background for modal */
            color: #fff;
            /* White text color for modal content */
        }

        .modal-body button.btn {
            background-color: #ffc107;
            /* Yellow color for payment method buttons */
        }

        .custom-container {
            max-width: 1600px;
            /* Adjust as needed */
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.5rem;
            /* sm:px-6 */
            padding-right: 1.5rem;
            /* sm:px-6 */
        }

        @media (min-width: 1024px) {
            .custom-container {
                padding-left: 2rem;
                /* lg:px-8 */
                padding-right: 2rem;
                /* lg:px-8 */
            }
        }
    </style>
</head>

<body>
    <x-app-layout>

        <div class="custom-container">
            <div class="bg-darkgrey shadow-sm sm:rounded-lg overflow-hidden">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="p-6">
                    <!-- Existing Table -->
                    @if ($bookings->isEmpty())
                    <div class="alert alert-info" role="alert">
                        <p style="text-align: center">Belum ada booking</p>
                    </div>
                    @else
                    <table class="table table-bordered table-hover mb-4">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Status Submisi</th>
                                <th scope="col">Status Pembayaran</th>
                                <th scope="col">Batas Waktu</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Download Bukti PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->nama_barang }}</td>
                                <td>Rp {{ number_format($booking->total_harga, 2) }}</td>
                                <td>{{ $booking->status_submission }}</td>
                                <td>{{ $booking->status_payment }}</td>
                                <td>
                                    @if ($booking->due_date)
                                    @php
                                    $dueDate = new DateTime($booking->due_date);
                                    echo $dueDate->format('d-m-Y H:i');
                                    @endphp
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->status_payment == 'Belum dibayar')
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#paymentModal"
                                        onclick="setBookingId({{ $booking->id_booking }})">Bayar</button>
                                    <form action="{{ route('booking.destroy', $booking->id_booking) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                    @elseif ($booking->status_submission == 'Sah' && $booking->status_payment ==
                                    'Terbayar')
                                    <form action="{{ route('bookings.requestReturn', $booking->id_booking) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Permohonan kembalikan barang</button>
                                    </form>
                                    @elseif ($booking->status_submission == 'Telah Dikembalikan')
                                    <span class="text-success">Sudah dikembalikan</span>
                                    @else
                                    <span class="text-success">Sudah Bayar</span>
                                    @endif
                                </td>
                                <td>
                                    @if (($booking->status_submission == 'Sah' && $booking->status_payment ==
                                    'Terbayar'))
                                    <a href="{{ route('bookings.MembuatFakturPengiriman', $booking->id_booking) }}"
                                        class="btn btn-info btn-sm">Download Bukti Penyerahan</a>
                                    @elseif ($booking->status_submission == 'Telah Dikembalikan' && $booking->status_payment ==
                                    'Terbayar')
                                    <a href="{{ route('bookings.MembuatFakturPengembalian', $booking->id_booking) }}"
                                        class="btn btn-info btn-sm">Download Bukti Pengembalian</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Verifikasi Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="paymentForm" action="{{ route('bookings.updatePaymentStatus', ':id') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                                </div>
                                <button type="submit" class="btn btn-success">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let bookingId;
    
        function setBookingId(id) {
            bookingId = id;
            const form = document.getElementById('paymentForm');
            form.action = form.action.replace(':id', id);
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js">
    </script>
</body>

</html>