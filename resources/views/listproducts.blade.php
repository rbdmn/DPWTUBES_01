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
            background-color: rgba(71, 107, 69, 0.8);
            color: white;
            border: 1px solid black;
        }

        .table tbody td {
            background-color: rgba(60, 61, 60, 0.8);
            vertical-align: middle;
            text-align: center;
            padding: 10px;
            border: 1px solid black;
            color: white;
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
            style="background-image: url('images/yaya.jpg'); background-blend-mode: multiply; background-size: cover; background-position: center;">
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
                    <img src="{{asset('images/gambar.jpg')}}"
                        class="img-fluid" alt="test">
                    <div class="p-6" style="background-color: rgba(71, 107, 69, 0.8);">
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga Sewa Barang per hari</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Kuantitas</th>
                                    <th scope="col">Status Ketersediaan</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($list as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>Rp {{ number_format($item->harga_barang, 2) }}</td>
                                    <td>
                                        <img src="{{ asset('images/' . $item->foto_barang) }}" alt="Foto Barang" style="width: 100px; height: auto;">
                                    </td>
                                    <td>
                                        @if($item->status_ketersediaan)
                                        <form action="{{ route('cart.add', $item->id_barang) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" min="1" value="1" class="form-control input-small">
                                            <button type="submit" class="btn btn-primary btn-lg">+Keranjang</button>
                                        </form>
                                        @else
                                        <button class="btn btn-danger btn-lg" disabled>Stok Habis</button>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="{{ $item->status_ketersediaan ? 'text-success' : 'text-danger' }}">
                                            {{ $item->status_ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}
                                        </span>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js"></script>
</body>

</html>