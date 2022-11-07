
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
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">
    <title>{{ config('app.name') }} {{ __('Forgot Password') }}</title>
</head>

<body class="bg-light">
    <div class=" d-flex justify-content-between p-4">
        <span>Company logo</span>
        <span class="p-2 rounded" style="background: #1266F1; font-weight: 600">{{__('Email verification')}}</span>
        </div>

    <div class="container d-flex justify-content-center mt-5 ">
        <div class="row">
          <div class="col-md-1">

          </div>
          <div class="col-md-10">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded border border-white ">
                <div class="card-title d-flex justify-content-center">
                    <h2 class="h2" style="font-size:3rem;font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">Email Verification</h2>
                </div>
                <div class="card-body">
                    <div class="mb-4 text-sm text-muted ">
                         <p class="text-center">
                             {{ __('Thanks for signing up! Before getting started, could you verify your
                              email address by clicking on the link we just emailed
                            to you? If you didn\'t receive the email,
                           we will gladly send you another.')}}
                           </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p>

                        @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 text-sm text-success">
                            <small>
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </small>
                           </div>
                    @endif
                     </p>
                </div>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div class="d-grid col-6 mx-auto mt-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Resend Verification Email') }}
                    </button>
                   </div>
                 </form>
            </div>
         </div>
          <div class="col-md-1">

          </div>
        </div>
    </div>
</div>


      <div class="d-flex justify-content-center">
        <div class="position_element ">

            <footer>
    © <?php echo date('Y'); ?> Copyright
    <a class="text-reset fw-bold" href="#">{{config('app.name')}}.com</a>

  <!-- Copyright -->
            </footer>

    </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>
