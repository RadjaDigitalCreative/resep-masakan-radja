@extends('layouts.admin')

@section('heading', 'Kategori Baru')

@section('body')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.categories.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Nama Kategori</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : '' }}" required>
                @include('components.error', ['field' => 'name'])
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Tambah Kategori
                </button>
            </div>
        </div>
    </form>
@endsection
