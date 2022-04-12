<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PT. Tangara Mitrakom</title>
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="icon" type="image/x-icon" href="assets/tangara.png">
</head>
<body style="background-image: url('{{asset('images/server_room.jpeg')}}')">
    <h1>PT. Tangara Mitrakom</h1>
    <img src="{{Storage::url('images/tm.png')}}" alt="">
    <form method="POST" action="">
    <div class="row">
        <label for="email">Email</label>
        <input type="email" name="user_name" autocomplete="off" placeholder="Email">
    </div>
    <div class="row">
        <label for="password">Password</label>
        <input type="password" name="user_pass" placeholder="Password">
    </div>
    <button type="submit">Login</button>
    </form>
</body>
</html>