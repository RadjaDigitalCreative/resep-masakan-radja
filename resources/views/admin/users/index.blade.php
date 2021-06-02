@extends('layouts.admin')

@section('heading', 'User')

@section('body')
<table id="myTable" class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>E-mail</th>
            <th>Username</th>
            <th>Role</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr {{ $user->deleted_at ? 'class=text-danger' : '' }}>
            <td>{{ $user->id }}</td>
            <td {{ ! $user->verified ? 'class=text-danger' : '' }}>{{ $user->email }}</td>
            <td title="{{ $user->slug }}">{{ $user->name }}</td>
            <td {{ $user->isAdmin() ? 'class=text-dark' : '' }}>{{ $user->role->name }}</td>
            <td class="text-right cell-buttons">
                <a href="{{ route('admin.users.edit', $user->id) }}">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
                <a href="{{ $user->deleted_at ? '#' : route('user.profile', $user->slug) }}">
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
        {{ $users->links() }}
    </div>
</div>

@endsection
