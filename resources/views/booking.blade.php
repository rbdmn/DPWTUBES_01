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
    </style>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="bg-darkgrey py-12" style="background-image: url('startbootstrap-grayscale-gh-pages/assets/img/campsite.jpg'); background-blend-mode: multiply; background-size: cover; background-position: center;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                            <form action="{{ route('bookings.updatePaymentStatus', $booking->id_booking) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Pay</button>
                                            </form>
                                        @elseif ($booking->status_submission == 'Confirmed')
                                            <form action="{{ route('bookings.returnItem', $booking->id_booking) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">Return</button>
                                            </form>
                                        @else
                                            <span class="text-success">Paid</span>
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
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
