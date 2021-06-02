@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @if (!empty($selectedCategory))
        <h1>{{ $selectedCategory }}</h1>
        @endif

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
            <ul class="list-group">
                @foreach ($categories as $category)
                <li class="list-group-item list-group-link">
                    <a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a>
                </li>
                @endforeach
                <li class="list-group-item list-group-link">
                    <a href="{{ route('categories') }}">Semua Resep</a>
                </li>
            </ul>
        </div>
        @foreach ($recipes as $recipe)
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
            @include('components.recipe', ['recipe' => $recipe])
        </div>
        @endforeach
    </div>
    <div class="text-center center-paginator">
        {{ $recipes->links() }}
    </div>
</div>
@endsection
