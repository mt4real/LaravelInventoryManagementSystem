<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--custom CSS-->
    <!--custom CSS-->
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">
    <title>{{ config('app.name') }} {{ __('Forgot Password') }}</title>
</head>

<body class="bg-light">
    <div class=" d-flex justify-content-between p-4">
        <span>Company logo</span>
        <span class="p-2 rounded" style="background: #1266F1; font-weight: 600">{{ __('Create an account') }}</span>
    </div>


    <div class=" container-fluid d-flex justify-content-center  align-content-center mt-5 ">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4 text-sm text-muted text-center">
                    <P>{{ __('Forgot your password? No problem ') }} {{ __('.') }}
                        <em>{{ __(' Just let us know your email address and we will email you a password ') }}</em></P>
                    <p>{{ __('reset link that will allow you to choose a new one.') }}</p>
                </div>
                <p>
                    @if (Session::has('status'))
                        <div class="alert alert-success alert-dismissible fade show " role="alert">

                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                arial-label="close">x</button>
                            <strong class="">{{ session('status') }}</strong>

                        </div>
                    @endif

                </p>
            </div>
        </div>
        <div class="col-md-6 offset-md-1 mx-auto">
            <div class="card border border-white bg-white rounded shadow-sm">
                @include('layouts.utilities.user-daialog')
                <div class="card-title">
                    <h3 style="font-size:2rem;font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif"
                        class="h3 text-center mt-2">{{ __('Forgot Password') }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <label for="email" class="mb-3">Email</label>
                                <input type="text"
                                    class=" @error('email') is-invalid @enderror form-control form-control-lg mb-3"
                                    id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                    autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="d-grid col-10 mx-auto">
                                    <button type="submit"
                                        class="btn btn-primary  btn-lg">{{ __('Email Password Reset Link') }}</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="position_element ">

            <footer>
                © <?php echo date('Y'); ?> Copyright
                <a class="text-reset fw-bold" href="#">{{ config('app.name') }}.com</a>

                <!-- Copyright -->
            </footer>


            <!-- Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>


</body>

</html>
