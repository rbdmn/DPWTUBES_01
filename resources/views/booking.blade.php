<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-darkgrey {
            background-color: rgba(51, 47, 47, 0.633);
        }

        body {
            background-color: #f8f9fa;
            background-image: url('{{ url(' images/scenerynight.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
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
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 text-center">{{ __('Bookings') }}</h2>
        </x-slot>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="p-6">
                        <h2>Bookings List:</h2>
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Status Submission</th>
                                    <th scope="col">Status Payment</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Download Bukti PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $booking->nama_barang }}</td>
                                    <td>Rp {{ number_format($booking->total_harga, 2) }}</td>
                                    <td>{{ $booking->status_submission }}</td>
                                    <td>{{ $booking->status_payment }}</td>
                                    <td>
                                        @if ($booking->status_payment == 'Unpaid')
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#paymentModal"
                                            onclick="setBookingId({{ $booking->id_booking }})">Pay</button>
                                        <form action="{{ route('booking.destroy', $booking->id_booking) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        @elseif ($booking->status_submission == 'Confirmed' && $booking->status_payment
                                        == 'Paid')
                                        <form action="{{ route('bookings.requestReturn', $booking->id_booking) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm">Request Return</button>
                                        </form>
                                        @elseif ($booking->status_submission == 'Returned')
                                        <span class="text-success">Returned</span>
                                        @else
                                        <span class="text-success">Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (($booking->status_submission == 'Confirmed' && $booking->status_payment ==
                                        'Paid'))
                                        <a href="{{ route('bookings.generateSubmissionInvoice', $booking->id_booking) }}"
                                            class="btn btn-info btn-sm">Download Submission Invoice</a>
                                        @elseif ($booking->status_submission == 'Returned' && $booking->status_payment
                                        == 'Paid')
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

        <!-- Modal -->
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Verification Check</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please choose a payment method:</p>
                        <button type="button" class="btn btn-success" id="payWithCredit">Credit</button>
                        <button type="button" class="btn btn-info" id="payWithQRIS">QRIS</button>
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
    }

    document.getElementById('payWithCredit').addEventListener('click', function() {
        submitPayment('credit');
    });

    document.getElementById('payWithQRIS').addEventListener('click', function() {
        submitPayment('qris');
    });

    function submitPayment(method) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("bookings.updatePaymentStatus", ":id") }}'.replace(':id', bookingId);
        form.style.display = 'none';

        const token = document.createElement('input');
        token.name = '_token';
        token.value = '{{ csrf_token() }}';
        form.appendChild(token);

        const methodInput = document.createElement('input');
        methodInput.name = 'payment_method';
        methodInput.value = method;
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
    }
    </script>
</body>

</html>