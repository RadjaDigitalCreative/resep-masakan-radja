@extends('layouts.admin')

@section('heading', 'Bumbu')

@section('body')

    @include('admin.table', ['table' => 'spices', 'data' => $spices])

    <div class="bottom-buttons">
        <div class="form-group">
            <a class="btn btn-primary" href="{{ route('admin.spices.create') }}">Buat bumbu baru</a>
        </div>
        <div class="pull-right">
            {{ $spices->links() }}
        </div>
    </div>

@endsection
