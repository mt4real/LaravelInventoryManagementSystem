@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                {{-- <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <p>
                        Sales History Report
                    </p>
                    <a href="{{route('admin.salesHistoryReport')}}" class="btn btn-lg btn-primary" role="button">
                        <i data-fa-symbol="share" class="fa-solid fa-share-from-square fa-3x"></i><svg class="icon">
                            <use xlink:href="#share"></use>
                        </svg><strong class="font-small">{{ __('View Sales History Report') }}</strong>
                    </a>
                </div> --}}

                <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <p>
                        Product Supplied Report
                    </p>
                    <a href="{{route('admin.suppliedProductsReport')}}" class="btn btn-lg btn-primary" role="button">
                        <i data-fa-symbol="layer-group" class="fa-solid fa-layer-group fa-3x"></i><svg class="icon">
                            <use xlink:href="#layer-group"></use>
                        </svg><strong class="font-small">{{ __('View Product Supplied Report') }}</strong>
                    </a>
                </div>
                {{-- <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <p>
                        Payment Report
                    </p>
                    <a href="{{route('admin.paymentsHistoryReport')}}" class="btn btn-lg btn-primary" role="button">
                        <i data-fa-symbol="layer-group" class="fa-solid fa-layer-group fa-3x"></i><svg class="icon">
                            <use xlink:href="#layer-group"></use>
                        </svg><strong class="font-small">{{ __('View Payments Report') }}</strong>
                    </a>
                </div> --}}
            </div>

        </div>
    </main>
@endsection
