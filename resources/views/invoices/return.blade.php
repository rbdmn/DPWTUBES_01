<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice Return</title>
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
            <h1>Bukti Pengembalian</h1>
            <p>Bukti untuk pengembalian barang</p>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $booking->user->name }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>{{ $booking->nama_barang }}</td>
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
                Bahwa pada hari dan jam {{ $booking->updated_at }}, pihak pengurus legislatif telah menerima kembali {{ $booking->nama_barang }} sebanyak {{ $booking->keranjang->jumlah_barang_sewa }} dari saudara/i {{ $booking->user->name }}. 
                <br><br> Dengan diterimanya kembali barang ini, pihak pengurus menyatakan bahwa saudara/i {{ $booking->user->name }} telah memenuhi tanggung jawab atas barang yang disewakan. 
                
                <br><br> Terima kasih atas kerja samanya, dan kami berharap dapat melayani Anda kembali di masa mendatang.
                
                <br><br> Hormat kami,
                
                <br><br> RENTALBOSS OWNER, BOSS Erlangga.
                
                </p>
        </div>
        <div class="footer">
            <p>&copy; 2024 RENTALBOSS. Seluruh hak cipta.</p>
        </div>
    </div>
</body>

</html>