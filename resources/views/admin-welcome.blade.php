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
    <title>{{ __('Welcome to') }} {{ config('app.name') }} {{ __('Home page') }}</title>
</head>

<body style="background: #fff">

    <div class="d-flex justify-content-center  align-content-center mt-5 ">
        <div class="col-md-6 offset-md-1 mx-auto">

            <form id="companyForm" method="POST" enctype="multipart/form-data">

                @csrf
                <!-- One "tab" for each step in the form: -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 tab slideInAnimation" style="margin-top:2%">
                        <h3 class="h3 d-flex justify-content-center primary-text-colour font-big slideInAnimation">
                            {{ __('Welcome to Easylife Solution ') }}</h3>
                        <h3 class="h3 d-flex align-items-center justify-content-center" style="transition: 0.3s all">
                            {{ __('Gas Management System') }}
                        </h3>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 tab" style="margin-top:2%">
                        <h5 class="mb-4 font-big" id="company_label">
                            <i>{{ __('what is the name of your company?') }}</i>
                        </h5>
                        <input type="text" name="company_name" id="company_name"
                            class="p-3 form-control form-control-lg"
                            placeholder="Company Name" autofocus value="{{ old('company_name') }}"
                            data-ajax-input="company_name" aria-labelledby="company name">
                        <span class="invalid-feedback" role="alert" data-ajax-feedback="company_name"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 tab" style="margin-top:2%">
                        <h5 class="mb-4 font-big" id="companyEmail_label">
                            <i>{{ __('your company email?') }}</i>
                        </h5>
                        <input type="text" name="company_email" id="company_email"
                            class="p-3 form-control form-control-lg"
                            placeholder="Company Email" autofocus value="{{ old('company_email') }}"
                            data-ajax-input="company_email" aria-labelledby="company email">
                        <span class="invalid-feedback" role="alert" data-ajax-feedback="company_email"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 tab" style="margin-top:2%">
                        <h5 class="mb-4 font-big" id="companyMobile_label">
                            <i>{{ __('your company mobile number?') }}</i>
                        </h5>
                        <input type="text" name="company_mobile" id="company_mobile"
                            class="p-3 form-control form-control-lg"
                            placeholder="Company Mobile" autofocus value="{{ old('company_mobile') }}"
                            data-ajax-input="company_mobile" aria-labelledby="company mobile">
                        <span class="invalid-feedback" role="alert" data-ajax-feedback="company_mobile"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12  tab" style="margin-top:2%">
                        <h5 class="mb-4 font-big"><i>{{ __('upload your company logo') }}</i></h5>
                        <input type="file" name="company_image" id="company_image" accept="image/*"
                            class="form-control form-control-lg p-3" data-ajax-input="company_image"
                            aria-labelledby="Company Image">
                        <span class="invalid-feedback" role="alert" data-ajax-feedback="company_image"></span>
                    </div>
                </div>


                <div class="d-flex justify-content-between mt-5 slideInAnimation">
                    <button type="button" class="btn btn-primary" id="prevBtn"
                        onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    <button type="submitBtn" class="btn btn-primary" id="submitBtn"
                        style="display: none">Submit</button>
                </div>


            </form>

             <!-- Modal -->
    <div class="modal fade" id="easySolutionAdminWelcomeModal" tabindex="-1" aria-labelledby="easyLifeSolutionAdminModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button id="companyModalButton" type="button" class="btn btn-outline-primary">Continue</button>

            </div>
        </div>
    </div>
</div>


        </div>
    </div>



    <!--javascript library-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/backend/site.js') }}"></script>


</body>

</html>
