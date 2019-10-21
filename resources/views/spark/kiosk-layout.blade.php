@extends('spark::layouts.app')

@push('scripts')
    <style type="text/css">
        .fa-icon {
            color: #9aa5ac; 
            padding-right: 35px; 
            display: inline-block;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.2/mousetrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
@endpush

@section('content')
    <spark-kiosk :user="user" inline-template>
        <div class="spark-screen container">
            <div class="row">
                <!-- Tabs -->
                <div class="col-md-3 spark-settings-tabs">
                    @include('spark-manual-billing::spark.kiosk-menu')
                </div>

                <!-- Tab cards -->
                <div class="col-md-9">
                    @yield('content-inside')
                </div>
            </div>
        </div>
    </spark-kiosk>
@endsection
