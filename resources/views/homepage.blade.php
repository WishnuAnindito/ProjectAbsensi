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
<body>
    <h1>Login</h1>
    <form method="POST" action="{{--route('/logintest')--}}">
    <div class="row">
        <label for="email">Email</label>
        <input type="email" name="user_name" autocomplete="off" placeholder="email@example.com">
    </div>
    <div class="row">
        <label for="password">Password</label>
        <input type="password" name="user_pass">
    </div>
    <button type="submit">Login</button>
    </form>
</body>
</html>