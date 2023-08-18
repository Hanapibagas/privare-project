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
    <h2 style="text-align: center">Daftar Rekap Customer</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Jumlah Belanja</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <style>
                .customer-silver {
                    background-color: silver;
                    color: black;
                    padding: 10px;
                    border-radius: 5px;
                    margin-bottom: 10px;
                }

                .customer-gold {
                    background-color: gold;
                    color: black;
                    padding: 10px;
                    border-radius: 5px;
                    margin-bottom: 10px;
                }

                .customer-platinum {
                    background-color: #e5e4e2;
                    color: black;
                    padding: 10px;
                    border-radius: 5px;
                    margin-bottom: 10px;
                }
            </style>
            @foreach ( $users as $key => $files )
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <th>{{ $files->name }}</th>
                <th>{{ $files->email }}</th>
                <th>{{ $files->alamat }}</th>
                <th>{{ $totalTransactions[$files->id] }}</th>
                <th class="customer-{{ $files->tanda }}"> {{ $files->tanda }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="signature">
        <p class="name">Penanggung jawab</p><br><br><br>
        <p class="position">Owner</p>
    </div>
</body>

</html>