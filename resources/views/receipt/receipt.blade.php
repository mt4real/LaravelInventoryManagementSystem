<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/backend/app.css') }}">
    <!--custom CSS-->
    <link rel="stylesheet" href="{{ asset('css/backend/print.css') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet"
        as="font" crossorigin>
    <title>{{ config('app.name') }} {{ __('Receipt printing page') }}</title>
</head>

<body>
    <div class="ticket">
        <img src="./logo.png" alt="Logo">
        <p id="company_name" class="centered">

        </p>
        <p id="customerName" class="centered">

        </p>
        <table>
            <thead>
                <tr>
                    <th  class="productName">Product Name</th>
                    <th class="quantity">QTY</th>
                    <th class="price">Price</th>
                    <th class="amount">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="prd_name" class="productName"></td>
                    <td id="qty" class="quantity"></td>
                    <td id="pr" class="price"></td>
                    <td id="sub_total" class="amount"></td>
                </tr>

            </tbody>
        </table>
        <div class="d-flex justify-content-start">
            <span>Change</span>
            <p id="balance_collect">

            </p>
        </div>

        <div class="d-flex justify-content-end">
          <span>Grand Total:</span>
            <p id="overAll_total">

            </p>
        </div>
        <p class="centered">Thanks for your purchase!
            <br>parzibyte.me/blog
        </p>
    </div>
<script src="{{asset('js/backend/realLive.js')}}">

</script>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
</body>

</html>
