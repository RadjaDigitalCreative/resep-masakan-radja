@extends('layouts.recipes')

@section('heading', 'Resep Terbaru')

@section('form')
<form class="form-horizontal" role="form" method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ ($errors->has('title') || $errors->has('slug')) ? ' has-error' : '' }}">
        <label for="title" class="col-md-2 control-label">Nama</label>
        <div class="col-md-9">
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
            @if ($errors->has('title') || $errors->has('slug'))
            <span class="help-block">
                <strong>{{ $errors->first('title') ? $errors->first('title') : $errors->first('slug') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
        <label for="categories" class="col-md-2 control-label">Kategori</label>
        <div class="col-md-9">
            <select name="categories[]" id="categories" class="select form-control" multiple="multiple">
                @foreach ($categories as $id => $name)
                @if (collect(old('categories'))->contains($id))
                <option value="{{ $id }}" selected>{{ $name }}</option>
                @else
                <option value="{{ $id }}">{{ $name }}</option>
                @endif
                @endforeach
            </select>
            @include('components.error', ['field' => 'categories'])
        </div>
    </div>

    <div class="form-group{{ $errors->has('ingredients') ? ' has-error' : '' }}">
        <label for="ingredients" class="col-md-2 control-label">Bahan Baku</label>
        <div class="col-md-9">
            <select name="ingredients[]" id="ingredients" class="select form-control" multiple="multiple">
                @foreach ($ingredients as $id => $name)
                @if (collect(old('ingredients'))->contains($id))
                <option value="{{ $id }}" selected>{{ $name }}</option>
                @else
                <option value="{{ $id }}">{{ $name }}</option>
                @endif
                @endforeach
            </select>
            @include('components.error', ['field' => 'ingredients'])
        </div>
    </div>

    <div class="form-group{{ $errors->has('spices') ? ' has-error' : '' }}">
        <label for="spices" class="col-md-2 control-label">Bumbu</label>
        <div class="col-md-9">
            <select name="spices[]" id="spices" class="select form-control" multiple="multiple">
                @foreach ($spices as $id => $name)
                @if (collect(old('spices'))->contains($id))
                <option value="{{ $id }}" selected>{{ $name }}</option>
                @else
                <option value="{{ $id }}">{{ $name }}</option>
                @endif
                @endforeach
            </select>
            @include('components.error', ['field' => 'spices'])
        </div>
    </div>

    <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
        <label for="thumbnail" class="col-md-2 control-label">Foto</label>
        <div class="col-md-9 info">
            <input type="file" name="thumbnail" id="thumbnail" accept=".jpg,.jpeg,.png">
            @include('components.error', ['field' => 'thumbnail'])
        </div>
    </div>

    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
        <label for="body" class="col-md-2 control-label">Text</label>
        <div class="col-md-9">
            <textarea name="body" id="body" class="form-control" rows="10">{{ old('body') }}</textarea>
            @include('components.error', ['field' => 'body'])
        </div>
    </div>

    <div class="col-md-6 form-group{{ $errors->has('difficulties') ? ' has-error' : '' }}">
        <label for="difficulties" class="col-md-4 control-label">Kesulitan</label>
        <div class="col-md-8">
            @foreach ($difficulties as $id => $name)
            <div class="radio">
                <label><input type="radio" name="difficulty_id" value="{{ $id }}" {{ old('difficulty_id') == $id ? 'checked' : '' }}>{{ $name }}</label>
            </div>
            @endforeach
            @include('components.error', ['field' => 'difficulties'])
        </div>
    </div>
    <div class="col-md-6 form-group{{ $errors->has('durations') ? ' has-error' : '' }}">
        <label for="durations" class="col-md-5 control-label">Waktu yang dibutuhkan</label>
        <div class="col-md-7">
            @foreach ($durations as $id => $name)
            <div class="radio">
                <label><input type="radio" name="duration_id" value="{{ $id }}" {{ old('duration_id') == $id ? 'checked' : '' }}>{{ $name }}</label>
            </div>
            @endforeach
            @include('components.error', ['field' => 'durations'])
        </div>
    </div>
    <div class="form-group{{ ($errors->has('title') || $errors->has('slug')) ? ' has-error' : '' }}">
        <label for="video" class="col-md-2 control-label">Link Youtube</label>
        <div class="col-md-7">
            <input id="video" placeholder="example: https://www.youtube.com/embed/VwqTRU9Kr8c" type="text" class="form-control" name="video" value="{{ old('video') }}" required autofocus>
            @if ($errors->has('video') || $errors->has('slug'))
            <span class="help-block">
                <strong>{{ $errors->first('video') ? $errors->first('video') : $errors->first('slug') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-2">
            <a target="_blank" class="btn btn-success" href="https://www.youtube.com/watch?v=ZnuwB35GYMY">Lihat Tutor</a>
            
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-9 col-md-offset-2">
            <button type="submit" class="btn btn-primary">
                Masukkan Resep
            </button>
        </div>
    </div>
</form>
@endsection
