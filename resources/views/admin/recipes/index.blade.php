@extends('layouts.admin')

@section('heading', 'Resep Masakan')

@section('body')
<table id="myTable" class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Username</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recipes as $recipe)
        <tr {{ $recipe->deleted_at ? 'class=text-danger' : '' }}>
            <td>{{ $recipe->id }}</td>
            <td title="{{ $recipe->slug }}">{{ $recipe->title }}</td>
            <td>{{ implode(', ', $recipe->categories->pluck('name')->toArray()) }}</td>
            <td title="{{ $recipe->user ? $recipe->user->slug : '' }}">
                {{ $recipe->user ? $recipe->user->name : '-' }}
            </td>
            <td class="text-right cell-buttons">
                <a href="{{ route('recipes.edit', $recipe->id) }}" title="Upravit">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
                <a href="{{ $recipe->deleted_at ? '#' : route('recipes.show', $recipe->slug) }}" title="Zobrazit">
                    <i class="glyphicon glyphicon-share-alt"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="bottom-buttons">
    <div class="form-group"></div>
    <div class="pull-right">
        {{ $recipes->links() }}
    </div>
</div>

@endsection
