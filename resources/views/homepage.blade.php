<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Absen</title>
    {{-- <link rel="stylesheet" href="css/homepage.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- <link rel="icon" type="image/x-icon" href="assets/tangara.png"> --}}
    <script src="https://kit.fontawesome.com/f9efa1e251.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body  style="background-color: #C1D1D5">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="text-center mb-4">
                    <img src="{{Storage::url('images/tm.png')}}" alt="">
                </div>
                <h1 class="mb-4 text-center">Attendance Management System</h1>
                <br> <br>
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="row mb-4">
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text bg-light" id="username">
                                    <i class="fa-solid fa-user"></i>
                                </span> 
                                <input type="email" name="user_name" autocomplete="off" placeholder="Insert Your Email" class="form-control py-2" aria-describedby="username">
                            </div>
                        </div>
                        @error('user_name')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text bg-light" id="password">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="user_pass" placeholder="Insert Your Password" class="form-control py-2" aria-describedby="password">
                            </div>
                        </div>
                        @error('user_pass')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn text-dark" style="background-color: #56E533; padding-right: 30%; padding-left:30%;">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <div class="text-end p-0 m-0">
                    <img src="{{Storage::url('images/vectorhomepage.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
</html>