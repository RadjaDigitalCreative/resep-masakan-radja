@extends('layouts.admin')

@section('heading', 'Bahan Baku')

@section('body')

    @include('admin.table', ['table' => 'ingredients', 'data' => $ingredients])

    <div class="bottom-buttons">
        <div class="form-group">
            <a class="btn btn-primary" href="{{ route('admin.ingredients.create') }}">Buat bahan baru</a>
        </div>
        <div class="pull-right">
            {{ $ingredients->links() }}
        </div>
    </div>

@endsection
