@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row reset-password">
        <div class="col s12 m6 offset-m2">
            <div class="panel panel-default">
                <div class="panel-heading">Resetovanje Lozinke</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col s12 control-label">E-Mail Adresa</label>

                            <div class="col s12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col s12 m12 l8 offset-l2">
                                <button type="submit" class="btn btn-primary" style="font-size: 0.77em;">
                                    Resetovanje Lozinke
                                     <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
