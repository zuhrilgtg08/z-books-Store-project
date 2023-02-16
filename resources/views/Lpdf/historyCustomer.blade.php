<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Boostrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <style>
            table {
                font-size: 1em;
                font-weight: 400;
                color: #000;
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size: 12px;
            }

            th {
                border: 1px solid #333333;
                background-color: #dddddd;
                text-align: center;
                padding: 8px;
            }

            td {
                border: 1px solid #3d3b3b;
                padding: 8px 8px 0px 8px;
            }

            tr:nth-child(even) {
                background-color: #F5F5F5;
            }
        </style>
</head>
<body>
    <div class="container mt-4">
        <main class="py-4">
            <div class="my-5 text-center mb-5">
                <h3>Detail Pembayaran</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body mx-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="fw-bolder">Terima kasih atas pembelian Anda</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <ul class="list-unstyled">
                                        <li class="text-black">Nama : {{ Auth::user()->name }}</li>
                                        <li class="text-danger mt-1"><span class="text-black">Invoice :
                                            </span>#{{ $noInvoice }}
                                        </li>
                                        <li class="text-black mt-1">Provinsi : {{ $province }}</li>
                                        <li class="text-black mt-1">Kota/Kabupaten : {{ $kota }}</li>
                                        <li class="text-black mt-1">Alamat : {{ $alamat }}</li>
                                        <li class="text-black mt-1">Status Pembayaran : {{ $status }}</li>
                                        <li class="text-success mt-1"><span class="text-black">Email :
                                            </span>{{ Auth::user()->email }}</li>
                                        <li class="text-success mt-1"><span class="text-black">No Telp :
                                            </span> {{ Auth::user()->number_phone }}
                                        </li>
                                    </ul>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Buku</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($dataOrder as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->buku->judul_buku }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>@currency($item->buku->harga)</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr class="my-4 text-black">
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-md-8 text-end">
                                            <ul class="list-unstyled">
                                                <li class="text-black">Kurir : {{ $kurir }}</li>
                                                <li class="text-black">Paket : {{ $paket }}</li>
                                                <li class="text-black">Harga Ongkir : @currency($ongkir)</li>
                                                <li class="text-black">Total Harga Pembelian : @currency($beli)</li>
                                                <li class="text-black mt-2">
                                                    <h3 class="text-success fw-bold">Total : @currency($total)</h3>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!--Boostrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>
</html>
