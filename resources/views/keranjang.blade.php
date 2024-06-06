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
        .bg-darkgrey {
            background-color: rgba(51, 47, 47, 0.633);
        }

        .input-small {
            width: 60px;
        }

        body {
            background-color: #f8f9fa;
            background-image: url('{{ url('images/forest2.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Add this line */
            height: 100vh;
            margin: 0;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight" style="text-align: center">
                {{ __('Keranjang') }}
            </h2>
        </x-slot>

        <section class="h-100">
            <div class="container h-100 py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    @foreach ($cart as $item)
                    @if (($item->sudah_book) == 0)
                    <div class="card rounded-3 mb-4" style="background-color: greenyellow">
                        <div class="card-body p-4" style="background-color: greenyellow">
                            <div class="row d-flex justify-content-between align-items-center">
                                <!-- Nama Barang -->
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2">{{ $item->nama_barang_sewa }}</p>
                                </div>
                                <!-- Jumlah Disewa -->
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2">Jumlah Disewa: {{ $item->jumlah_barang_sewa }}</p>
                                </div>
                                <!-- Harga -->
                                <div class="col-md-3 col-lg-2 col-xl-2">
                                    <h5 class="mb-0">Rp {{ number_format($item->barang->harga_barang, 2) }}</h5>
                                </div>
                                <!-- Durasi -->
                                Durasi / hari
                                <div class="col-md-2 col-lg-2 col-xl-2 d-flex align-items-center">
                                    <form action="{{ route('cart.update', $item->id_keranjang) }}" method="POST"
                                        class="d-flex align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.parentNode.submit()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input id="form1" min="0" name="durasi" value="{{ $item->durasi }}"
                                            type="number" class="form-control form-control-sm mx-2" />
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.parentNode.submit()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                                <!-- Aksi -->
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <form action="{{ route('cart.destroy', $item->id_keranjang) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger btn btn-link p-0">
                                            <i class="fas fa-trash fa-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach


                    <div class="card" style="background-color: greenyellow">
                        <div class="card-body" style="background-color: greenyellow">
                            <form action="{{ route('bookings.store') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-block btn-lg" style="background-color: black; color: white; border: 2px solid white;">Submit All</button>
                            </form>
                        </div>
                    </div>
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