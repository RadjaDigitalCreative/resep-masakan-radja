@extends('layouts.admin')

@section('heading', 'Kategori')

@section('body')

@include('admin.table', ['table' => 'categories', 'data' => $categories])

<div class="bottom-buttons">
	<div class="form-group">
		<a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Buat kategori baru</a>
	</div>
	<div class="pull-right">
		{{ $categories->links() }}
	</div>
</div>

@endsection
