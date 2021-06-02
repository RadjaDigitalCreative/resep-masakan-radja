@extends('layouts.settings')

@section('heading', 'Ubah Password')

@section('form')
<form class="form-horizontal" role="form" method="POST" action="{{ route('user.update.password') }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <input type="hidden" name="id" value="{{ $user->id }}">

    <div class="form-group{{ ($errors->has('password') || $e = session('password_error')) ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Ubah Kata Sandi</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @elseif ($e)
            <span class="help-block">
                <strong>{{ $e }}</strong>
            </span>
            @endif
        </div>
    </div>
    <br>

    <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
        <label for="newpassword" class="col-md-4 control-label">Nové heslo</label>
        <div class="col-md-6">
            <input id="newpassword" type="password" class="form-control" name="newpassword" required>
            @include('components.error', ['field' => 'newpassword'])
        </div>
    </div>
    <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
        <label for="newpassword-confirm" class="col-md-4 control-label">Kata sandi baru</label>
        <div class="col-md-6">
            <input id="newpassword-confirm" type="password" class="form-control" name="newpassword_confirmation" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
              Simpan kata sandi baru
          </button>
      </div>
  </div>
</form>
@endsection
