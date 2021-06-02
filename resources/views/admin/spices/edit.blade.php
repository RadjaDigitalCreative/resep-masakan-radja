@extends('layouts.admin')

@section('heading', 'Update Bumbu')

@section('body')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.spices.update', $spice->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Nama Bumbu</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $spice->name }}" required>
                @include('components.error', ['field' => 'name'])
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Update Bumbu
                </button>
            </div>
        </div>
    </form>
    {{-- @if ($spice->deleted_at)
        <form class="form-right" role="form" method="POST" action="{{ route('admin.spices.restore', $spice->id) }}">
            {{ csrf_field() }}
            <button type="submit" class="btn-link delete-button">Kembalikan Data</button>
        </form>
    @else
        <form class="form-right" role="form" method="POST" action="{{ route('admin.spices.destroy', $spice->id) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn-link delete-button">Hapus Data</button>
        </form>
    @endif --}}
@endsection
