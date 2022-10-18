<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table{
            border-collapse: collapse;
        }

        td{
            padding-right: 5px;
            padding-left: 5px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('img/prints/KOOP.jpg') }}" style="width: 100%; margin-top: -20px;" alt="">
    <div style="padding: 10px;">
        @yield('content')
    </div>
</body>
</html>