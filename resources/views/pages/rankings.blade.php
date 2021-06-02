@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Paling populer bulan ini</h1>

        @foreach ($favourites as $recipe)
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
            @include('components.recipe', ['recipe' => $recipe])
        </div>
        @endforeach
    </div>
    <br>
    <div class="row">
        <h1>Yang Paling sering dikunjungi</h1>

        @foreach ($discussed as $recipe)
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
            @include('components.recipe', ['recipe' => $recipe])
        </div>
        @endforeach
    </div>

</div>
@endsection
