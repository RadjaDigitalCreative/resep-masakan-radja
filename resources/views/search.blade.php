@extends('layouts.app')

@section('meta_title', 'Co dnes uvařit? | Recepty')

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">

    @include('components.flash')   
    <div class="centered-outer homepage">
        <div class="centered-middle">
            <div class="row">
                <div class="col-md-12">
                    <h1>Cari Resep Masakan</h1>
                </div>
                <!-- <div class="col-md-1"></div> -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form class="centered-inner form-group" action="{{ route('search')}}" >
                        {{ csrf_field() }}

                        <select name="recipes[]" id="recipes" class="select form-control" multiple="multiple">
                            @foreach ($recipes as $recipe)
                            <option value="{{ $recipe->title }}">{{ $recipe->title }}</option>
                            @endforeach
                        </select>

                        <button id="search-button" type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-search"></i> Temukan resep
                        </button>
                    </form>
                </div>
                <!-- <div class="col-md-1"></div> -->

            </div>
            <div class="explanation">
              <p>Tulis apa yang Anda temukan di lemari es, di dapur, atau di ruang bawah tanah dan &nbsp; temukan resep untuk hidangan yang bisa Anda buat darinya!</p>
          </div>

      </div>
  </div>
  @if($teling != NULL)

  <div class="row home-bottom">
    <h3>Resep Pencarian</h3>

    @foreach ($teling as $recipe)
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
        @include('components.search', ['recipe' => $recipe])
    </div>
    @endforeach
</div>
@else($teling2 != NULL)
<div class="row home-bottom">
    <h3>Resep Pencarian</h3>

    @foreach ($teling2 as $recipe)
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
        <div class="panel recipe">
            <a class="link" href="{{ route('recipes.show', $recipe[0]->slug) }}">
                <img src="{{ URL::to('/') }}/img/recipes/{{ $recipe[0]->thumbnail }}" alt="" class="img-responsive">
                <div class="info">
                    <div class="heading">
                        {{ $recipe[0]->title }}
                    </div>
                    <div class="categories">
                        {{ $recipe[0]->name }}
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif

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

