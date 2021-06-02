@extends('layouts.app')

@section('head')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('heading', 'Administrace')</div>

                @include('components.flash')

                <div class="panel-body">
                    @yield('body')
                </div>
            </div>
        </div>

        @include('admin.sidebar')
    </div>
</div>
@endsection

@section('scripts')
{{--

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
 
    <script type="text/javascript">
        $('select').select2({
            theme: "bootstrap"
        });
    </script>
    --}}
    @endsection
