@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('heading', 'Nastavení')</div>

                @include('components.flash')

                <div class="panel-body">
                    @yield('form')
                </div>
            </div>
        </div>

        @include('auth.sidebar')
    </div>
</div>
@endsection
