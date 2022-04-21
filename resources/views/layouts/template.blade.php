<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@700&family=Montserrat:wght@400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="https://kit.fontawesome.com/f9efa1e251.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            $('#employeelist').DataTable();
        });
    </script>
    <script type="text/javascript">
        function showTime() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            var date = new Date(),
                time = new Date(Date(
                date.getFullYear(),
                date.getMonth(),
                date.getDate(),
                date.getHours(),
                date.getMinutes(),
                date.getSeconds()
                ));
    
            document.getElementById('time').innerHTML = time.toLocaleTimeString();
            document.getElementById('date').innerHTML = time.toLocaleDateString(undefined, options);
        }
    
        setInterval(showTime, 100);
        </script>
        <script type="text/javascript">
        $('form#check-in-loc').submit(function(e){
        // $('#check-in-loc-btn').on("click",function() {
        if ($('#check-out-timezone').is(':disabled') && $('#check-out-description').is(':disabled') && $('#check-out-submit').is(':disabled')) {
            $('#check-out-timezone').removeAttr('disabled', false);
            $('#check-out-description').removeAttr('disabled', false);
            $('#check-out-submit').prop('disabled', false);
            // $('#check-out-timezone').removeAttr('disabled');
            // $('#check-out-description').removeAttr('disabled');
            // $('#check-out-submit').removeAttr('disabled');
        } else {
            $('#check-out-timezone').attr('disabled', 'disabled');
            $('#check-out-description').attr('disabled', 'disabled');
            $('#check-out-submit').attr('disabled', 'disabled');
        }
        });
        </script>
    <title>@yield('title')</title>
</head>
<body>
    @yield('nav')
</body>
</html>