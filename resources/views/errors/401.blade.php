<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

       <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--custom css-->
    <link rel="stylesheet" href="{{asset('css/frontend_css/pdf.css')}}">
   <!--- Fontawesome css --->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>{{config('app.name')}}-Unauthorized page</title>
    </head>

    <body style="background:#FBFBFB">
       <div class="row">
           <div class="col-md-12 col-12 col-xl-12 col-sm-12 col-lg-12">
            <div class="d-flex justify-content-center" style="margin-top:12%">
                <h1 class="h1 font-extra-big display-1" style="font-weight: 800">
                    <strong>401</strong>
                </h1>

           </div>
           <div class="col-md-12 col-xl-12 col-sm-12 col-lg-12">
            <div class="text-center">
                <h2 class="mt-4">Whoops!Unauthorized page.</h2>
                <p class="text-muted mt-2">You are not authorized to view this page</p>
                <div class="mt-4 pt-2">
                    <a style="background: #1266F1;" class="btn btn-lg btn-primary waves-effect waves-light" role="button" href="{{route('admin.dashboard')}}">Back to
                        home page</a>
                </div>

            </div>
           </div>
           </div>
       </div>
    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

</body>
</html>
