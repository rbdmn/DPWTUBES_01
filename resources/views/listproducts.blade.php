<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTALBOSS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet" />
    <style>
        .bg-darkgrey {
            background-color: rgba(48, 47, 51, 0.633);
        }

        .input-small {
            width: 60px;
        }

        .table thead th {
            vertical-align: middle;
            text-align: center;
            background-color: rgba(71, 107, 69, 0.8); /* Grey foresty vibe color */
            color: white; /* Text color for thead */
            border: 1px solid black; /* Black border */
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
            padding: 10px;
            border: 1px solid black; /* Black border */
        }

        .table img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-control.input-small {
            width: 80px;
            display: inline-block;
        }

        .btn {
            width: 150px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <x-app-layout>

        <div class="bg-darkgrey py-12"
            style="background-image: url('startbootstrap-grayscale-gh-pages/assets/img/campsite.jpg'); background-color: rgba(0, 0, 0, 0.5); background-blend-mode: multiply; background-size: cover; background-position: center;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-forest-green overflow-hidden shadow-sm sm:rounded-lg">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <img src="https://fastly.picsum.photos/id/10/2500/700.jpg?hmac=-V8-VKooViy76bhIeIrdDOmdmtT6xTIiA3U2ff3hKcI"
                        class="img-fluid" alt="test">
                    <div class="p-6" style="background-color: rgba(71, 107, 69, 0.8);">
                        <h1 style="color: white; text-align: center;">List Produk beserta harga per harinya</h1>
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga Sewa Barang per hari</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Kuantitas</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($list as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>Rp {{ number_format($item->harga_barang, 2) }}</td>
                                    <td>
                                        <img src="{{ asset('images/' . $item->foto_barang) }}" alt="Foto Barang"
                                            style="width: 100px; height: auto;">
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.add', $item->id_barang) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" min="1" value="0"
                                                class="form-control input-small">
                                            <button type="submit" class="btn btn-primary btn-lg">Tambah</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Shopping Cart Section -->
                    {{-- <section class="h-100" style="background-color: #eee;">
                        <div class="container h-100 py-5">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-10">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                                        <div>
                                            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                                    class="text-body">price <i class="fas fa-angle-down mt-1"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                    @foreach ($list as $item)
                                    <div class="card rounded-3 mb-4">
                                        <div class="card-body p-4">
                                            <div class="row d-flex justify-content-between align-items-center">
                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <img src="{{ asset('images/' . $item->foto_barang) }}"
                                                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                    <p class="lead fw-normal mb-2">{{ $item->nama_barang }}</p>
                                                    <p><span class="text-muted">Size: </span>M <span
                                                            class="text-muted">Color: </span>Grey</p>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                    <button data-mdb-button-init data-mdb-ripple-init
                                                        class="btn btn-link px-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input id="form1" min="0" name="quantity" value="2" type="number"
                                                        class="form-control form-control-sm" />
                                                    <button data-mdb-button-init data-mdb-ripple-init
                                                        class="btn btn-link px-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                    <h5 class="mb-0">Rp {{ number_format($item->harga_barang, 2) }}</h5>
                                                </div>
                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                    <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="card mb-4">
                                        <div class="card-body p-4 d-flex flex-row">
                                            <div data-mdb-input-init class="form-outline flex-fill">
                                                <input type="text" id="form1" class="form-control form-control-lg" />
                                                <label class="form-label" for="form1">Discount code</label>
                                            </div>
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-outline-warning btn-lg ms-3">Apply</button>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End of Shopping Cart Section --> --}}

                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js"></script>
</body>

</html>
