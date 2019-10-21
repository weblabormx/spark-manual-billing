@extends('spark-manual-billing::spark.kiosk-layout')
@section('content-inside')
    <div class="tab-content">
        <!-- Announcements -->
        <div role="tabcard" class="tab-pane" id="announcements">
            @include('spark::kiosk.announcements')
        </div>

        <!-- Metrics -->
        <div role="tabcard" class="tab-pane" id="metrics">
            @include('spark::kiosk.metrics')
        </div>

        <!-- User Management -->
        <div role="tabcard" class="tab-pane" id="users">
            @include('spark::kiosk.users')
        </div>
    </div>
@endsection
