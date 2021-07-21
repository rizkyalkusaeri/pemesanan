<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Baru</title>
</head>

<body>
    <h2>Hai, admin</h2>
    <p>Ada order baru nih dari {{ $user->name }} dengan email {{ $user->email }} </p>
    <p>Silahkan klik link ini untuk menanggapi <a href="http://127.0.0.1:8000/order">DISINI</a></p>
</body>

</html>
