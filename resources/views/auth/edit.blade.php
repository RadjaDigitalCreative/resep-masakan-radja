@extends('layouts.settings')

@section('heading', 'Update Profil')

@section('form')
<form class="form-horizontal" role="form" method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <input type="hidden" name="id" value="{{ $user->id }}">

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Username</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $user->name }}" required>
            @include('components.error', ['field' => 'name'])
        </div>
    </div>

    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        <label for="slug" class="col-md-4 control-label">Alamat Profil</label>
        <div class="col-md-6">
            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') ? old('slug') : $user->slug }}" required>6
            @include('components.error', ['field' => 'slug'])
            <span class="help-block helper-slug">
                Váš profil bude na {{ url('/uzivatel/') }}/<span>{{ $user->slug }}</span>
            </span>
        </div>
    </div>

    <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
        <label for="bio" class="col-md-4 control-label">Tentang Saya</label>
        <div class="col-md-6">
            <textarea name="bio" id="bio" class="form-control" rows="6">{{ old('bio') ? old('bio') : $user->bio }}</textarea>
            @if ($errors->has('bio'))
            <span class="help-block">
                <strong>{{ $errors->first('bio') }}</strong>
            </span>
            @else
            <span class="help-block helper-bio">
                Maximálně <span>140</span> znaků
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
        <label for="avatar" class="col-md-4 control-label">Foto Profil</label>
        <div class="col-md-6 info">
            <img src="{{ $user->avatarPath() }}" alt="" class="avatar-img">
            <input type="file" name="avatar" id="avatar" accept=".jpg,.jpeg,.png">
            @include('components.error', ['field' => 'avatar'])
        </div>
    </div>
    @if ($user->isPro())
    <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
        <label for="cover" class="col-md-4 control-label">Foto Sampul</label>
        <div class="col-md-6 info">
            @if ($user->cover)
            <img src="{{ $user->coverPath() }}" alt="" class="cover-img-form thumbnail">
            @endif
            <input type="file" name="cover" id="cover" accept=".jpg,.jpeg,.png">
            @include('components.error', ['field' => 'cover'])
            <span class="help-block">Úvodní fotografie bude mít 750x400 pixelů</span>
        </div>
    </div>
    @endif

    <div class="form-group">
        <label class="col-md-4 control-label">Profil Dibuat</label>
        <div class="col-md-6 info">
            {{ $user->created_at->format("j. n. Y") }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Type Pengguna</label>
        <div class="col-md-6 info">
            {{ $user->role->name }} {{ $user->verified ? '' : '&nbsp; (Neověřený e-mail)' }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Update Profil
            </button>
        </div>
    </div>
</form>
@endsection
