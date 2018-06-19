@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <!--  CONTACT  -->
    <div class="contact">
      <div class="container">
          <div class="title">
                <h1>Kontakt</h1>
          </div>
      </div>
      <div class="container">
          <div class="row contact-info">
              <div class="col s12 m12 l4">
                  <div class="col s2">
                      <i class="material-icons">place</i>
                  </div>
                  <div class="col s10">
                      <h5>Adresa</h5>
                      <p>KREATIVNI HOBI</p>
                      <p>Prve pruge 37P - Zemun</p>
                  </div>
              </div>
              <div class="col s12 m12 l4">
                   <div class="col s2">
                      <i class="material-icons">query_builder</i>
                  </div>
                  <div class="col s10">
                      <h5>Radno vreme</h5>
                      <p>Ponedeljak - petak 9.00 - 20.00h</p>
                      <p>Subota 10.00 - 15.00h</p>
                  </div>
              </div>
              <div class="col s12 m12 l4">
                   <div class="col s2">
                      <i class="material-icons">phone</i>
                  </div>
                  <div class="col s10">
                      <h5>Telefon</h5>
                      <p><a href="tel:+381113196258">011/319-62-58</a></p>
                      <p><a href="tel:+381612844956">061/28-44-956</a></p>
                  </div>
              </div>
          </div>
      </div>
      <div class="bg-gray">
          <div class="container">
             <div class="row contact-form">
                <div id="map" class="col s12 m5 offset-m1 l5 offset-l1"></div>
                <div class="col s12 m4 offset-m1 l4 offset-l1 user">
                     <form class="s12" id="contact" name="contact" method="POST" action="">
                          <div class="input-field col s12 ">
                              <input placeholder="*Ime i prezime:" id="name" name="name" type="text" class="validate" />
                          </div>
                          <div class="input-field col s12">
                              <input placeholder="*E-mail:" id="email" name="email" type="email" class="validate" />
                          </div>
                          <div class="input-field col s12">
                              <input placeholder="Telefon:" id="phone" name="phone" type="text" class="validate" />
                          </div>
                          <div class="input-field col s12">
                              <textarea class="materialize-textarea">Vaša poruka</textarea>
                          </div>
                          <div class="col s12">
                             <p>*Obavezna polja</p>
                          </div>
                          <div class="input-field col s12 m6 l4 center-align">
                              <input id="contact-send" name="contact-send" type="submit" class="btn-flat send-button validate" value="Pošalji" />
                          </div>
                     </form>
                </div>
              </div>
          </div>
      </div>
  </div> 
@endsection
@section( 'script' )
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtvJCg4PK5KL6lJSowsR9n4do9M6LxDSU&callback=app.createMap" async defer></script>
@endsection