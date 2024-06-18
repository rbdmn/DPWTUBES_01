<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Denda</title>
    <!-- Tambahkan tautan ke CSS Bootstrap dan Font Awesome di sini -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #1b2f34;
            background-image: url('{{ url('images/forest3.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            background-color: #2b402b;
            max-width: 500px;
            margin: 0 auto;
        }

        .form-label {
            color: #d3e0dc;
        }

        .btn-primary {
            background-color: #445c46;
            border-color: #2e3e31;
            color: #d3e0dc;
        }

        .btn-primary:hover {
            background-color: #334733;
            border-color: #1e261e;
        }

        .card-header {
            background-color: rgba(71, 107, 69, 0.8);
            color: #d3e0dc;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="mb-0">Pembayaran Denda</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('bookings.payFine', $booking->id_booking) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="bukti_pembayaran_denda" class="form-label">Unggah Bukti Pembayaran Denda</label>
                                    <input type="file" class="form-control" id="bukti_pembayaran_denda" name="bukti_pembayaran_denda" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran Denda</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <!-- Tambahkan tautan ke JavaScript Bootstrap di sini -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>