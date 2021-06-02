@extends('layouts.app')

@section('meta_title', 'Co dnes uvařit? | Recepty')

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-12 center">
        <h3 align="center" style="">Tulis apa yang Anda temukan di lemari es, di dapur, atau di ruang bawah tanah dan &nbsp; temukan resep untuk hidangan yang bisa Anda buat darinya!</h3>
    </div>
</div> 
</div>

<div class="container">
  <div class="row ">
    <h3>Resep Favorit</h3>
    @foreach ($favourites as $recipe)
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
        @include('components.recipe', ['recipe' => $recipe])
    </div>
    @endforeach
</div>
<br>
<div class="row">
    <h3>Resep Baru</h3>
    @foreach ($fresh as $recipe)
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
        @include('components.recipe', ['recipe' => $recipe])
    </div>
    @endforeach
</div>
</div>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $('select').select2({
        theme: "bootstrap"
    });
</script>
@endsection

