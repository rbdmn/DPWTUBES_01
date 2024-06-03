<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTALBOSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .bg-darkgrey {
            background-color: rgba(51, 47, 47, 0.633);
        }
        .input-small {
            width: 60px; 
        }
    </style>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Keranjang') }}
        </h2>
    </x-slot>

    <div class="bg-darkgrey py-12" style="background-image: url('startbootstrap-grayscale-gh-pages/assets/img/campsite.jpg'); background-color: rgba(0, 0, 0, 0.5); background-blend-mode: multiply; background-size: cover; background-position: center;">
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

                <img src="https://fastly.picsum.photos/id/27/2500/700.jpg?hmac=HrI6qndItZSp3ETIGODwF31Gkz66W-PebuoM0hVJdPw" class="img-fluid" alt="test">
                <div class="p-6">
                    <h2>Isi keranjang:</h2>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah disewa</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @php
                            $iterasi = 1;
                        @endphp
                        <tbody>
                            @foreach ($cart as $item)
                                @if (($item->sudah_book) == 0)
                                    <tr>
                                        <th scope="row">{{ $iterasi }}</th>
                                        <td>{{ $item->nama_barang_sewa }}</td>
                                        <td>Rp {{ number_format($item->barang->harga_barang, 2) }}</td>
                                        <td>{{ $item->jumlah_barang_sewa }}</td>
                                        <td>
                                            <form action="{{ route('cart.destroy', $item->id_keranjang) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $iterasi++;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">Submit All</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
