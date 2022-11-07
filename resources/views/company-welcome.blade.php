<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='csrf-token' content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--custom CSS-->
    <link rel="stylesheet" href="{{ asset('css/backend/site.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">
    <title>{{ __('Welcome to') }} {{ config('app.name') }} {{ __('Company Welcome page') }}</title>
</head>

<body style="background: #fff">

    <div class="d-flex justify-content-center align-content-center mt-5 ">

        <p class="font-big">{{__('Welcome to')}} {{config('app.name')}}
        {{__(', You have successfully registered your company name in order to use our Web
        Based Solution Inventory Mannagement System in your organisation')}}</p>
        <p class="font-small">{{__('You can click on this link')}} <a href="{{route('register')}}">here</a> {{__('in order to register')}}</p>
        <p class="font-small">{{__('Thanks for using our solution, cheers')}}</p>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>



</body>

</html>
