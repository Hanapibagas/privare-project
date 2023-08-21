<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Data Laporan Pengadu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        /* CSS untuk tanda tangan */
        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature p {
            margin-bottom: 0;
        }

        .signature .name {
            font-weight: bold;
        }

        .signature .position {
            font-style: italic;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">Daftar Rekap Transaksi</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Tanggal order</th>
                <th scope="col">Kode Pemesanan</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah barang</th>
                <th scope="col">Harga jual</th>
                <th scope="col">Diskon</th>
                <th scope="col">Harga beli</th>
                <th scope="col">Untung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $detailsTransaksi as $items )
            <tr>
                <th>{{ $items->order_date }}</th>
                <th>{{ $items->tranaksi->kode_pemesanan }}</th>
                <th>{{ $items->Product->name }}</th>
                <th>{{ $items->jumlah_barang }}</th>
                <th>Rp.{{ number_format($items->selling_price) }}</th>
                <th>{{ $items->discount }}%</th>
                <th>Rp.{{ number_format($items->purchase_price) }}</th>
                <th>Rp.{{ number_format($items->profit) }}</th>
            </tr>
            @endforeach
            <tr>
                <th colspan="4" style="text-align: center">Total penjualan</th>
                <th>Rp.{{ number_format($total) }}</th>
                <th></th>
                <th>Rp.{{ number_format($purchase_price) }}</th>
                <th>Rp.{{ number_format($profit) }}</th>
            </tr>
        </tbody>
    </table>
    <div class="signature">
        <p class="name">Penanggung jawab</p><br><br><br>
        <p class="position">Owner</p>
    </div>
</body>

</html>