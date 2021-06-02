@extends('layouts.settings')

@section('heading', 'Update Email')

@section('form')
<form class="form-horizontal" role="form" method="POST" action="{{ route('user.update.email') }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <input type="hidden" name="id" value="{{ $user->id }}">

    <div class="form-group">
        <label class="col-md-4 control-label">Email saat ini</label>
        <div class="col-md-6 info">
            {{ $user->email }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Diverifikasi</label>
        <div class="col-md-6 info">
            {{ $user->verified ? 'Ano' : 'Ne' }}
        </div>
    </div>
    <br>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-mail Baru</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @include('components.error', ['field' => 'email'])
        </div>
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email-confirm" class="col-md-4 control-label">Konfirmasi E-mail</label>
        <div class="col-md-6">
            <input id="email-confirm" type="email" class="form-control" name="email_confirmation" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Update E-mail
            </button>
        </div>
    </div>
</form>
@endsection
