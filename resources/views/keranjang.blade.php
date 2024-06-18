<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTALBOSS</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Updated custom styles with greenish and foresty palette */
        .bg-darkgreen {
            background-color: #2b402b;
        }

        .input-small {
            width: 60px;
        }

        body {
            background-color: #d3e0dc;
            background-image: url('{{ url('images/forest3.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
        }

        .card {
            background-color: rgba(181, 211, 180, 0.8);
        }

        .card-body {
            background-color: rgba(71, 107, 69, 0.8);
        }

        .card table thead {
            color: black !important;
        }

        .card table tbody {
            background-color: white !important;
        }

        .submit-btn {
            background-color: #445c46;
            color: white;
            border: 2px solid #2e3e31;
        }

        .submit-btn:hover {
            background-color: #445c46;
            border-color: #445c46;
        }
    </style>
</head>

<body>
    <x-app-layout>

        <section class="vh-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        @php
                        $mark = 0; // Inisialisasi variabel mark
                        @endphp

                        @forelse ($cart as $item)
                        @if ($item->sudah_book == 0)
                        @php
                        $itemTotal = ($item->barang->harga_barang * $item->jumlah_barang_sewa) * $item->durasi;
                        $mark = 1; // Update mark menjadi 1 karena ada item dalam keranjang
                        @endphp
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <!-- Konten kartu untuk setiap barang di keranjang -->
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="{{ asset('images/' . $item->barang->foto_barang) }}"
                                            alt="Product Image"
                                            style="border: 10px solid rgba(71, 107, 69, 0.8); border-radius: 5px;">
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="big text-muted mb-4 pb-2">Nama Barang</p>
                                            <p class="lead fw-normal mb-0">{{ $item->nama_barang_sewa }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="big text-muted mb-4 pb-2">Jumlah Disewa</p>
                                            <p class="lead fw-normal mb-0">{{ $item->jumlah_barang_sewa }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="big text-muted mb-4 pb-2">Harga per hari</p>
                                            <p class="lead fw-normal mb-0">Rp {{
                                                number_format($item->barang->harga_barang, 2) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="big text-muted mb-4 pb-2" style="text-align: center">Durasi per
                                                hari</p>
                                            <!-- Input field for duration -->
                                            <form action="{{ route('cart.update', $item->id_keranjang) }}" method="POST"
                                                class="d-flex align-items-center justify-content-center">
                                                @csrf
                                                @method('PUT')
                                                <button data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.parentNode.submit()">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input id="form1" min="0" name="durasi" value="{{ $item->durasi }}"
                                                    type="number"
                                                    class="form-control form-control-sm mx-2 input-small text-center" />
                                                <button data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.parentNode.submit()">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="big text-muted mb-4 pb-2">Total Harga</p>
                                            <p class="lead fw-normal mb-0">Rp {{ number_format($itemTotal, 2) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center mt-3">
                                        <!-- Each product has its own submit button -->
                                        <a href="{{ route('payment', ['id_keranjang' => $item->id_keranjang]) }}" class="btn btn-lg submit-btn me-3">Bayar dan sewa sekarang</a>
                                        <!-- Delete action button -->
                                        <form action="{{ route('cart.destroy', $item->id_keranjang) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger btn btn-link p-0 mt-3">
                                                <i class="fas fa-trash fa-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                        @php
                        $mark = 0; // Update mark menjadi 0 karena keranjang kosong
                        @endphp
                        <div class="card mb-4">
                            <div class="card-body p-4 text-center">
                                <p class="lead fw-normal mb-2">Keranjang Anda kosong.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

    </x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js">
    </script>
</body>

</html>