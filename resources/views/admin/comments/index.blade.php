@extends('layouts.admin')

@section('heading', 'Komentar')

@section('body')
    <table id="myTable"  class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Resep</th>
                <th>Isi Komentar</th>
                <th class="text-right">Tanggal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>
                        @if ($comment->user)
                        <a href="{{ route('user.profile', $comment->user->slug) }}">
                            {{ str_limit($comment->user->name, 18) }}
                        </a>
                        @else - @endif
                    </td>
                    <td>
                        @if ($comment->recipe)
                        <a href="{{ route('recipes.show', $comment->recipe->slug) }}" title="{{ $comment->recipe->title }}">
                            {{ $comment->recipe->id }}
                        </a>
                        @else - @endif
                    </td>
                    <td>
                        <small>{{ str_limit($comment->body, 60) }}</small>
                    </td>
                    <td class="text-right" style="min-width:120px">{{ $comment->updated_at->format('G:i j. n. Y') }}</td>
                    <td class="text-right cell-buttons">
                        <form role="form" method="POST" action="{{ route('comments.destroy', $comment->id) }}" style="display: inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn-link delete-button" style="padding:0;border:none">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </form>
                        <a href="{{ $comment->recipe ? route('recipes.show', $comment->recipe->slug).'#komentare' : '#' }}">
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
            {{ $comments->links() }}
        </div>
    </div>

@endsection
