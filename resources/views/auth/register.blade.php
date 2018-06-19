@extends('layouts.app')
@section('style')
@endsection
@section('content')
     <!--  REGISTER  -->
    <div class="user">
      <div class="container title">
          <h1>Registruj se</h1>
          <img src="{{asset('images/down-arrow.svg')}}" class="hide-on-small-only" alt="down arrow">
      </div>
      <div class="bg-gray">
          <div class="container register">
             <div class="row">
                  <form class="s12" id="register" name="register" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                         <!--<div class="row">
                              <div class="file-field input-field col s12 m5 l5 offset-m1 offset-l1">
                                    <div class="btn">
                                      <span>File</span>
                                      <input type="file" name="avatar">
                                    </div>
                                    <div class="file-path-wrapper">
                                      <input placeholder = "Dodaj datoteku" class="file-path validate" type="text" disabled readonly>
                                    </div>
                                </div>
                                <div class="input-field col s12 m5 l5">
                                  <input placeholder="*Korisničko ime:" id="username" name="name" type="text" class="validate">
                              </div>
                          </div>-->
                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                              <input placeholder="*Ime:" id="first_name" name="first_name" type="text" class="validate">
                              @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="input-field col s12 m5 l5">
                              <input placeholder="*Prezime:" id="last_name" name="last_name" type="text" class="validate">
                              @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                          </div>
                    </div>
                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                                    <input placeholder="*E-mail:" id="email" name="email" type="email" class="validate">
                                          @if ($errors->has('email'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('email') }}</strong>
                                              </span>
                                          @endif
                          </div>
                          <div class="input-field col s12 m5 l5">
                                  <input placeholder="*Adresa:" id="address" name="address" type="text" class="validate" >
                                          @if ($errors->has('address'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('address') }}</strong>
                                              </span>
                                          @endif
                        </div>
                    </div>

                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                                  <input placeholder="*Grad:" id="place" name="city" type="text" class="validate">
                                          @if ($errors->has('city'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('city') }}</strong>
                                              </span>
                                          @endif
                          </div>

                          <div class="input-field col s12 m5 l5">
                                  <input placeholder="Telefon:" id="phone" name="phone" type="text" class="validate">
                          </div>
                    </div>
                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                                  <input placeholder="*Poštanski broj:" id="zip_code" name="zip" type="text" class="validate">
                                      @if ($errors->has('zip'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('zip') }}</strong>
                                          </span>
                                      @endif
                          </div>

                          <div class="input-field col s12 m5 l5">
                                  <input placeholder="*Zemlja:" id="country" name="country" type="text" class="validate">
                                      @if ($errors->has('country'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('country') }}</strong>
                                          </span>
                                      @endif
                          </div>
                    </div>
                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                                <input placeholder="*Lozinka:" id="password" name="password" type="password" class="validate">
                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                          </div>

                        <div class="input-field col s12 m5 l5">
                            <input placeholder="*Ponovi lozinku:" id="confirmPassword" name="password_confirmation" type="password" class="validate" />
                        </div>
                    </div>
                    <div class="col s12 m10 l10 offset-l1 center-align">
                            <button class="btn waves-effect waves-light user-button" type="submit" id="register" >
                                    Registruj se
                                <i class="material-icons right">send</i>
                            </button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
@endsection
@section( 'script' )
@endsection