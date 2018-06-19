@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <!--  LOGIN  -->
    <div class="user" v-cloak>
      <div class="title">
          <h1>Za korisnike</h1>
          <img src="images/down-arrow.svg" class="hide-on-small-only" alt="down arrow" />
      </div>
      <div class="bg-gray">
          <div class="container login">
             <div class="row">
                  <form class="s12" id="login" name="login" method="POST" action="">
                      <div class="input-field col s12 m4 offset-s4 l4 offset-l4">
                          <input placeholder="*Korisničko ime ili e-mail:" id="email" name="email" type="text" class="validate" />
                      </div>
                      <div class="input-field col s12 m4 offset-s4 l4 offset-l4">
                          <input placeholder="*Lozinka:" id="password" name="password" type="password" class="validate" />
                      </div>
                      <div class="input-field col s12 m4 offset-s4 l4 offset-l4">
                          <a href="javascript:void(0)">Zaboravio/la si lozinku?</a>
                      </div>
                      <div class="input-field col s12 m4 offset-s4 l4 offset-l4 center-align">
                          <input id="login" name="login" type="submit" class="btn-flat user-button validate" value="Prijavi se" />
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
@endsection
@section( 'script' )
@endsection