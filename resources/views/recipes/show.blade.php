@extends('layouts.app')

@section('meta_title', $recipe->title.' | Resep')

@section('content')
<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

</div>
<div class="container recipe-detail relative">
    <h1>{{ $recipe->title }}</h1>

    <iframe style="display: block; margin: auto; border: 10px; " width="900" height="505" src="{{ $recipe->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <br><br>
    <div class="buttons categories">
        <h6 style="color: white;">Kategori</h6>
        @foreach ($recipe->categories as $category)
        <span>{{ $category->name }}</span>
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2 relative">
            @include('components.list-box', ['heading' => 'Bahan Baku', 'data' => $recipe->ingredients])

            @if ($recipe->spices->count())
            @include('components.list-box', ['heading' => 'Bumbu', 'data' => $recipe->spices])
            @endif
        </div>
        <div class="col-sm-6 col-md-5 col-lg-4 relative">
            <img src="{{ URL::to('/') }}/img/recipes/{{ $recipe->thumbnail }}" alt="" class="img-responsive thumbnail">
            <div class="buttons extra">
                @if ($recipe->duration)
                <span><i class="glyphicon glyphicon-time"></i>{{ $recipe->duration->name }}</span>
                @endif
                @if ($recipe->difficulty)
                <span><i class="glyphicon glyphicon-stats"></i>{{ $recipe->difficulty->name }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default how-to">
                <div class="panel-heading">Cara Masak</div>
                
                <div class="panel-body">
                    @foreach(explode(PHP_EOL, $recipe->body) as $paragraph)
                    <p>{{{ $paragraph }}}</p>
                    @endforeach
                    <hr>
                    <div class="big-buttons">
                        @if (Auth::user() && Auth::user()->canEditRecipe($recipe))
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary">
                            <i class="glyphicon glyphicon-pencil"></i>Update
                        </a>
                        @endif
                        @if (Auth::user())
                        <form method="POST" action="{{ route('recipes.like', $recipe->id) }}" class="inline" >
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-heart{{ ! $recipe->liked() ? '-empty' : '' }}"></i>
                                {{ $recipe->liked() ? 'Favorit' : 'Tambah Favorit' }}
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="glyphicon glyphicon-heart-empty"></i>Tambahkan ke Favorit
                        </a>
                        @endif
                    </div>
                    <hr>
                    @if ($recipe->user)
                    <p class="by-user">Penulis:
                        <a href="{{ route('user.profile', $recipe->user->slug) }}">
                            {{ $recipe->user->name }}
                        </a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="komentare">
        <div class="col-md-12">
            <div class="panel panel-default how-to">
                <div class="panel-heading">Komentar</div>
                <div class="panel-body">
                    @include('components.flash')
                    @if (! $comments->count())
                    <p>Belum ada yang menulis komentar untuk resep ini. Jadilah yang pertama!</p>
                    @else
                    @foreach ($comments as $comment)
                    @include('components.comment', ['comment' => $comment])
                    @endforeach
                    @endif
                    <div class="small-paginator comment-paginator">
                        {{ $comments->links() }}
                    </div>
                    <hr class="clear">
                    @if (Auth::user() && Auth::user()->verified)
                    <form role="form" method="POST" action="{{ route('comments.store', $recipe->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body">Tulis komentar Anda:</label>
                            <textarea name="body" id="body" class="form-control" required>{{ old('body') }}</textarea>
                            @if ($errors->has('body'))
                            <span class="help-block"><strong>{{ $errors->first('body') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tulis komentar</button>
                        </div>
                    </form>
                    @elseif (Auth::user() && !Auth::user()->verified)
                    <p>Anda harus memverifikasi akun Anda untuk mengirim komentar <a href="{{ route('settings.email') }}">Alamat e-mail</a>.</p>
                    @else
                    <p>Anda harus menulis komentar <a href="{{ route('login') }}">Login</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container similar">
    @if ($similar = $recipe->similarRecipes(4))
    <div class="row">
        <h3>Resep Serupa</h3>
        @foreach ($similar as $recipe)
        <div class="col-lg-3 col-sm-4 col-xs-6 col-xxs-12{{ $loop->last ? ' hidden-md hidden-sm' : '' }}">
            @include('components.recipe', ['recipe' => $recipe])
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
