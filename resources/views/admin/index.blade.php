<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Paid Bookings</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Status Submission</th>
                <th scope="col">Status Payment</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paidBookings as $booking)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->nama_barang }}</td>
                    <td>Rp {{ number_format($booking->total_harga, 2) }}</td>
                    <td>{{ $booking->status_submission }}</td>
                    <td>{{ $booking->status_payment }}</td>
                    <td>
                        <form action="{{ route('admin.confirmSubmission', $booking->id_booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Serahkan Barang</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
