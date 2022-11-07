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
    <title>{{ __('Welcome to') }} {{ config('app.name') }} {{ __('Reset Password page') }}</title>
</head>

<body class="bg-light">
    <div class=" d-flex justify-content-between p-4">
        <span>Company logo</span>
        <span class="p-2 rounded" style="background: #1266F1; font-weight: 600">{{__('Password reset')}}</span>
        </div>

    <div class="  d-flex justify-content-center  align-content-center mt-5 ">

        <div class="col-md-6 offset-md-1 mx-auto">
            <div class="card border border-white bg-white rounded shadow-sm">
                <div class="card-title">
                    <h3 class="h3 text-center mt-2">Reset Password Page</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <label for="email" class="mb-3">Email</label>
                            <input type="text" class="@error('email') is-invalid @enderror form-control-lg mb-3"
                                id="email" name="email" value="{{ old('email', $request->email) }}"
                                placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">

                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <label for="password" class="mb-3">Password</label>
                                <input type="password"
                                    class="@error('password') is-invalid @enderror form-control-lg mb-3" id="password"
                                    name="password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <label for="confirmation_password" class="mb-3">Password Confirmation</label>
                                <input type="password" class="@error('confirmation_password')
                                    @enderror form-control-lg mb-3"
                                    id="confirmation_password" name="confirmation_password" placeholder="Password">
                                @error('confirmation_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-grid col-10 mx-auto">
                                <button type="submit"
                                    class="btn btn-primary  btn-lg">{{ __('Password Confirmation') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>
