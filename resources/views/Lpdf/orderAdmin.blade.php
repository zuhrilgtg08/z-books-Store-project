<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            * {
                font-family: DejaVu Sans, sans-serif;
            }

            body {
                padding: 20px;
            }

            table {
                font-size: 1em;
                font-weight: 400;
                color: #000;
            }

            h2 {
                font-size: 1em;
                font-weight: 400;
            }

            h1 {
                font-size: 1.5em;

            }

            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size: 12px;
            }

            th {
                border: 1px solid #808080;
                background-color: #dddddd;
                text-align: center;
                padding: 8px;
            }

            td {
                border: 1px solid #747171;
                padding: 8px 8px 0px 8px;
            }

            tr:nth-child(even) {
                background-color: #F5F5F5;
            }
        </style>
    </head>

    <body>
        <center>
            <h1 style="text-decoration: underline;">DATA RIWAYAT PESANAN</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        <th>Judul Buku</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Harga Ongkir</th>
                        <th>Total Harga</th>
                        <th>Payment Status</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ( $data as $dt )
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $dt->order->uuid}}</td>
                            <td>{{ $dt->buku->judul_buku}}</td>
                            <td>{{ $dt->quantity}}</td>
                            <td>@currency($dt->buku->harga)</td>
                            <td>@currency($dt->order->harga_ongkir)</td>
                            <td>@currency($dt->order->harga_ongkir + $dt->order->total_belanja)</td>
                            <td>{{ $dt->payments}}</td>
                            <td>{{ date('Y-m-d', strtotime($dt->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </center>
    </body>
</html>