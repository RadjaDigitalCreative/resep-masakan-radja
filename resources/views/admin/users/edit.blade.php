@extends('layouts.admin')

@section('heading')
User <strong>( {{ $user->name }} )</strong>
@endsection

@section('body')
<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.users.update', $user->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <input type="hidden" name="id" value="{{ $user->id }}">

    <div class="form-group">
        <label class="col-md-4 control-label">E-mail</label>
        <div class="col-md-6 info">
            {{ $user->email }} {{ $user->verified ? '' : '&nbsp; (Neověřený e-mail)' }}
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Username</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $user->name }}" required>
            @include('components.error', ['field' => 'name'])
        </div>
    </div>

    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        <label for="slug" class="col-md-4 control-label">Profil</label>
        <div class="col-md-6">
            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') ? old('slug') : $user->slug }}" required>
            @include('components.error', ['field' => 'slug'])
        </div>
    </div>

    <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
        <label for="bio" class="col-md-4 control-label">Biografi</label>
        <div class="col-md-6">
            <textarea name="bio" id="bio" class="form-control" rows="6">{{ old('bio') ? old('bio') : $user->bio }}</textarea>
            @if ($errors->has('bio'))
            <span class="help-block">
                <strong>{{ $errors->first('bio') }}</strong>
            </span>
            @else
            <span class="help-block helper-bio">
                Maksimal <span>140</span> kata
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
        <label for="avatar" class="col-md-4 control-label">Foto Profil</label>
        <div class="col-md-6 info">
            <img src="{{ URL::to('/') }}/img/avatars/{{ $user->avatar }}" alt="" class="avatar-img">
            <div class="checkbox">
                <label><input type="checkbox" name="deleteAvatar" value="1"> gambar kecil</label>
            </div>
            @include('components.error', ['field' => 'avatar'])
        </div>
    </div>
    @if ($user->isPro() && $user->cover)
    <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
        <label for="cover" class="col-md-4 control-label">Foto Profil</label>
        <div class="col-md-6 info">
            <img src="{{ $user->coverPath() }}" alt="" class="cover-img-form thumbnail">
            <div class="checkbox">
                <label><input type="checkbox" name="deleteCover" value="1"> gambar kecil</label>
            </div>
            @include('components.error', ['field' => 'cover'])
        </div>
    </div>
    @endif

    <div class="form-group">
        <label class="col-md-4 control-label">Role Tipe</label>
        <div class="col-md-6 info">
            {{ $user->role->id }} - {{ $user->role->name }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Profil dibuat</label>
        <div class="col-md-6 info">
            {{ $user->created_at->format("H:i - j. n. Y") }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Profil diupdate</label>
        <div class="col-md-6 info">
            {{ $user->updated_at->format("H:i - j. n. Y") }}
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
@if ($user->deleted_at)
<form class="form-right" role="form" method="POST" action="{{ route('admin.users.restore', $user->id) }}">
    {{ csrf_field() }}
    <button type="submit" class="btn-link delete-button">Kembalikan Pengguna</button>
</form>
@else
<form class="form-right" role="form" method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn-link delete-button">Hapus Pengguna</button>
</form>
@endif
@endsection
