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
        .header, .footer {
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
        table, th, td {
            border: 1px solid black;
        }
        th, td {
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
            <h1>Invoice Return</h1>
            <p>Invoice for booking return</p>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>User Name</th>
                    <td>{{ $booking->user->name }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>{{ $booking->nama_barang }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp {{ number_format($booking->total_harga, 2) }}</td>
                </tr>
                <tr>
                    <th>Status Submission</th>
                    <td>{{ $booking->status_submission }}</td>
                </tr>
                <tr>
                    <th>Status Payment</th>
                    <td>{{ $booking->status_payment }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>