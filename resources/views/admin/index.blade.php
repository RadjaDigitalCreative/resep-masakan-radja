@extends('layouts.admin')

@section('heading', 'Statistik')

@section('body')
<table  class="table table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Total</th>
            <th>Tahun</th>
            <th>Bulan</th>
            <th>Minggu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $class)
        <tr>
            <td title="{{ $class['class'] }}">
                <a href="{{ url('administrace/' . str_slug($class['name'])) }}">
                    {{ $class['name'] }}
                </a>
            </td>
            <td>{{ $class['total'] }}</td>
            <td>{{ $class['year'] }}</td>
            <td>{{ $class['month'] }}</td>
            <td>{{ $class['week'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
