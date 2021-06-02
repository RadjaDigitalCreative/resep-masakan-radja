@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Resep Terbaru</h1>

        @if (! count($recipes))
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Kami Mulai dengan Resep Populer</div>

                    <div class="panel-body">
                        <p>Pemiliik Akun <em>{{ Auth::user()->name }}</em> Anda belum memiliki resep favorit. Anda dapat memulai segera dengan mengklik tombol untuk resep tertentu. <strong>Tambahkan ke Favorit</strong>.</p>
                    </div>
                </div>
            </div>
        @endif

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
