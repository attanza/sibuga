<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quotation#{{ $data['no'] }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-3">
        <table style="width: 100%;">
            <tr>
                <td width="25%" valign="center">
                    <p><strong>Quotation #{{ $data['no'] }}</strong></p>
                    {{ $data['location'] }}, {{ $data['date'] }}
                </td>
                <td width="50%" align="center" valign="center">
                    <h1>QUOTATION</h1>
                </td>
                <td width="25%" valign="center" align="right">
                    <img src="{{ url('img/sibuga_logo.png') }}" alt="Sibuga Logo " class="rounded d-block">

                </td>
            </tr>
        </table>
        <hr>
        <section id="to" class="mt-3">
            <p>
                Kepada Yth,<br>
                {{ $data['prefix'] }} {{ $data['contact'] }}
            </p>
            <p>
                <strong>{{ $data['customer'] }}</strong>
                <br>
                {{ $data['address'] }}
            </p>
            <p>
                Perihal : <strong>{{ $data['title'] }}</strong>
            </p>
        </section>
        <hr>

        <section id="greeting" class="mt-3">
            <p>Dengan Hormat,</p>
            <p>
                Melalui surat ini, kami bermaksud untuk mengajukan penawaran harga, adapun perincian
                barang dan harganya adalah sebagai berikut:
            </p>
        </section>


        <section id="products">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['products'] as $product)
                    <tr>
                        <td>{{ $product['no'] }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>IDR {{ $product['price'] }}</td>
                        <td>{{ $product['note'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <hr>
        <section id=" footer" class="mt-5">
            <h6>Keterangan: </h6>
            {!! $data['footer'] !!}
        </section>

        <section id="initiator" class="mt-5">
            <p>
                Terimakasih atas perhatian dan kerjasamanya.
            </p>
            <p>
                Hormat kami,
            </p>
            <p>
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data['no'], 'QRCODE')}}" alt="barcode" />
            </p>
            <p>
                {{ $data['initiator'] }}
            </p>
        </section>

    </div>
</body>

</html>
