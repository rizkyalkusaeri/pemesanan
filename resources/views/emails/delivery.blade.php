<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur dan Surat Jalan</title>
</head>

<body>
    <h2>Hai, {{ $order->user->name }}</h2>
    <p>Pesanan mu sudah dikirim, berikut kami lampirkan Faktur dan Surat Jalan nya
    </p>
    <p><a href="http://127.0.0.1:8000/storage/deliveries/{{ $order->delivery->faktur }}">Faktur </a></p>
    <p><a href="http://127.0.0.1:8000/storage/deliveries/{{ $order->delivery->surat_jalan }}">Surat Jalan</a></p>
    <p>Silahkan klik link ini untuk melihat status pesanan <a href="http://127.0.0.1:8000/order">DISINI</a>
    </p>
</body>

</html>
