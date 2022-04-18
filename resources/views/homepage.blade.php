<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Absen</title>
    <link rel="stylesheet" href="css/homepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/tangara.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container d-flex flex-column align-items-center justify-content-center background">
        <img class="" src="{{Storage::url('images/tm.png')}}" alt="">
        <form method="POST" action="{{route('login')}}">
            @csrf
            <div class="row">
                <label for="email">Email</label>
                <input type="email" name="user_name" autocomplete="off" placeholder="Email">
                @error('user_name')
                    <p class="text-danger">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="row">
                <label for="password">Password</label>
                <input type="password" name="user_pass" placeholder="Password">
                @error('user_pass')
                    <p class="text-danger">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>