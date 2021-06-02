@extends('layouts.app')

@section('meta_title', 'Uživatel '.$user->name.' | Resep')

@section('content')
<div class="container user-detail">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if ($user->isCook())
                    <p class="roles">
                        <span class="label label-{{ $user->role_id }}">
                            {{ $user->role->name }}
                        </span>
                    </p>
                    @endif
                    <p class="profile-buttons">
                        @if ($user->id == Auth::id())
                        <a href="{{ route('settings') }}" title="Nastavení">
                            <i class="glyphicon glyphicon-cog"></i>
                        </a>
                        @elseif (Auth::user()->isAdmin())
                        <a href="{{ route('admin.users.edit', $user->id) }}" title="Upravit uživatele">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        @endif
                    </p>
                    <div class="text-center cover-img absolute"{{ $user->cover ? ' style=background:url('.$user->coverPath().') no-repeat center center' : '' }}>
                        <img src="{{ URL::to('/') }}/img/avatars/{{ $user->avatar }}" alt="" class="avatar-img">
                    </div>
                    <h4 class="text-center">{{ $user->name }}</h4>
                    <p class="text-center bio">
                        {{ $user->bio }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($recipes as $recipe)
        <div class="col-md-4 col-sm-4 col-xs-6 col-xxs-12">
            @include('components.recipe', ['recipe' => $recipe])
        </div>
        @endforeach
    </div>
    <div class="text-center center-paginator">
        {{ $recipes->links() }}
    </div>
</div>
@endsection
