@extends('layouts.recipes')

@section('heading', 'Resep Saya')

@section('form')
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nama</th>
            <th class="text-right">Terakhir Dikelola</th>
            <th class="text-center">Edit</th>
            <th class="text-center" style="padding-right:0;padding-left:0">Tampilan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recipes as $recipe)
        <tr>
            <td>{{ $recipe->title }}</td>
            <td class="text-right">{{ $recipe->updated_at->format('G:i j. n. Y') }}</td>
            <td class="text-center">
                <a href="{{ route('recipes.edit', $recipe->id) }}">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
            </td>
            <td class="text-center">
                <a href="{{ route('recipes.show', $recipe->slug) }}">
                    <i class="glyphicon glyphicon-share-alt"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="bottom-buttons">
    <div class="form-group">
        <a class="btn btn-primary" href="{{ route('recipes.create') }}">Resep Baru</a>
    </div>
    <div class="pull-right">
        {{ $recipes->links() }}
    </div>
</div>
@endsection
