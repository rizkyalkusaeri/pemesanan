<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesanan mu hampir beres</title>
</head>

<body>
    <h2>Hai, {{ $order->user->name }}</h2>
    <p>Pesanan mu sudah hampir beres nih, berikut kami lampirkan invoice nya <a
            href="http://127.0.0.1:8000/storage/invoices/{{ $order->invoice->file }}">DISINI</a> </p>
    <p>Silahkan klik link ini untuk menanggapi kemudian upload bukti pembayaran pada sistem kami ya <a
            href="http://127.0.0.1:8000/order">DISINI</a></p>
</body>

</html>
