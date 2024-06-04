<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTALBOSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
            padding: 10px;
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
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
                {{ __('List Produk') }}
            </h2>
        </x-slot>

        <div class="bg-darkgrey py-12"
            style="background-image: url('startbootstrap-grayscale-gh-pages/assets/img/campsite.jpg'); background-color: rgba(0, 0, 0, 0.5); background-blend-mode: multiply; background-size: cover; background-position: center;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                    <div class="p-6">
                        <h2>List Produk beserta kredensialnya:</h2>
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga Sewa Barang per hari</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($list as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
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
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>