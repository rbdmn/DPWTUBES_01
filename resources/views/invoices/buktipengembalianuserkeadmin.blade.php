<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bukti Permintaan Pengembalian</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .header,
        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .content {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Bukti Permintaan Pengembalian</h1>
            <p>Bukti permintaan pengembalian barang</p>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $booking->user->name }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>{{ $booking->keranjang->barang->nama_barang }}</td>
                </tr>
                <tr>
                    <th>Jumlah Barang</th>
                    <td>{{ $booking->keranjang->jumlah_barang_sewa }}</td>
                </tr>
                <tr>
                    <th>Durasi per hari</th>
                    <td>{{ $booking->keranjang->durasi }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp {{ number_format($booking->total_harga, 2) }}</td>
                </tr>
                <tr>
                    <th>Batas Waktu Dikembalikan</th>
                    <td>{{ $booking->due_date }}</td>
                </tr>
            </table>
            <br>
            <br>
            <p>Dengan hormat,<br><br>
                Pada hari ini, {{ $booking->user->name }} mengajukan permintaan pengembalian barang {{
                $booking->keranjang->barang->nama_barang }} sebanyak {{ $booking->keranjang->jumlah_barang_sewa }}.
                Permintaan ini diajukan untuk dikonfirmasi oleh pihak admin.
                <br><br> Mohon untuk memproses permintaan pengembalian ini sesegera mungkin.

                <br><br> Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.

                {{-- <br><br> Hormat kami,

                <br><br> RENTALBOSS OWNER, BOSS Erlangga. --}}

            </p>
        </div>
        <div class="footer">
            <p>&copy; 2024 RENTALBOSS. Seluruh hak cipta.</p>
        </div>
    </div>
</body>

</html>