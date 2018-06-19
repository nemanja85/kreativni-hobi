
<div class="col s12">
	<img class="logo" src="{{asset('images/kh-logo.svg')}}" alt="logo">
</div>
<div style="font-size: 12px;">
@component('mail::message')
# Zahvaljujemo Vam se na narudžbini

@if($message['Response'] == 'Approved')
	Vaša narudžbina je Odobrena
@elseif($message['Response'] == 'Canceled')
	Vaša narudžbina je Poništena
@else
	Vaša narudžbina je Odbijena
@endif
</div>
<div class="col s12 m12 left-align" v-if="invoice" v-cloak="invoice">
   <h5 class="card-title grey-text text-darken-4 ">
      Potvrda vaše narudžbine putem broja narudžbine: {{$message['basket'][0][0]->Invoice}}
   </h5>
   <div id="invoice">
      <div class="invoice-header">
         <div class="row section">
            <div class="col s12 m6 l6 left-align address">
				<h1>Adresa plaćanja</h1>
               <p class="name m-bt" ><span class="strong">Ime:</span> {{ $message['user']->first_name }} {{ $message['user']->last_name }}</p>
               <p class="addres m-bt"><span class="strong">Adresa:</span> {{ $message['user']->address }}</p>
               <p class="city m-bt"><span class="strong">Grad:</span> {{ $message['user']->city }}</p>
               <p class="postal_code m-bt"><span class="strong">Poštanski kod:</span> {{ $message['user']->zip }}</p>
               <p class="country m-bt"><span class="strong">Zemlja:</span> {{ $message['user']->country }}</p>
               <p class="phone m-bt"><span class="strong">Tel:</span> {{ $message['user']->phone }}</p>
               <div class="invoce-company-contact">
                  <p class="m-bt">
                     <span class="mail"><span class="strong">E-mail:</span> {{ $message['user']->email }}</span>
                  </p>
               </div>
            </div>
            <div class="col s12 m6 l6 left-align address">
			   <h1>Adresa isporuke</h1>
               <p class="name m-bt"><span class="strong">Ime:</span> {{ $message['basket'][0][0]->ship_to_name }}</p>
               <p class="addres m-bt"><span class="strong">Adresa:</span> {{$message['basket'][0][0]->ship_to_address }}</p>
               <p class="city m-bt"><span class="strong">Grad:</span> {{ $message['basket'][0][0]->ship_to_city }}</p>
               <p class="postal_code m-bt"><span class="strong">Poštanski kod:</span> {{ $message['basket'][0][0]->ship_to_zip }}</p>
               <p class="country m-bt"><span class="strong">Zemlja:</span> {{ $message['basket'][0][0]->ship_to_country }}</p>
               <p class="phone m-bt"><span class="strong">Tel:</span> {{ $message['basket'][0][0]->phone }}</p>
               <div class="invoce-company-contact">
                  <p class="m-bt">
                     <span class="mail"><span class="strong">E-mail:</span> {{ $message['user']->email }}</span>
                  </p>
               </div>
            </div>
         </div>
      </div>
      <div style="clear: both;"></div>
      <table class="responsive-table highlight bordered product">
         <thead>
            <tr>
            	<th>Slika</th>
               <th colspan="2">Proizvod</th>
               <th>Cena</th>
               <th>Količina</th>
            </tr>
         </thead>
         <tbody>

          @isset($message['basket'][0][0])
            	@foreach($message['basket'][0][0]->ItemInBasket as $basket)
            		<tr>
            		   <td><img class="dd-option-image" src="{{asset('images')}}/{{$basket->img}}" alt="{{$basket->name}}"></td>
		               <td colspan="2"> {{$basket->name}}</td>
		               <td>{{$message['basket'][0][0]->price}} Din</td>
		               <td>{{$message['basket'][0][0]->amount}}</td>
		             </tr>
               	@endforeach
            @endisset

         </tbody>
      </table>
      <table class="responsive-table invoice-bg">
         <tr>
            <td>
               <h2 class="invoice-text font-white">Račun</h2>
            </td>
         </tr>
      	<tr>
      		<td>
      			<p class="strong font-white">Ukupno sa PDV 20%</p>
                <p class="header left-align font-white">{{$message['basket'][0][0]->sumare}} Din</p>
      		</td>
      		<td>
      			<p class="font-white strong font-white">Broj računa</p>
                <p class="header left-align font-white">{{$message['basket'][0][0]->Invoice}}</p>
      		</td>
      		<td>
      			<p class="font-white strong font-white">Datum</p>
                <p class="header left-align font-white">{{$message['basket'][0][0]->created_at}}</p>
      		</td>
      	</tr>
      </table>
      <div class="row notes">
      		<div class="col s12 m12  left-align">
			   <h4 class="card-title grey-text text-darken-4 ">
			      Zahvaljujemo Vam se na kupovini u Kreativnom hobi-u 
			   </h4>
			   <h5 class="card-title grey-text text-darken-4 ">
					14-DNEVNO PRAVO NA OTKAZIVANJE NARUDŽBINE 
			   </h5>
			   <p>
			   	Prilikom kupovine na KREATIVNIHOBI.com imate pravo da otkažete kupovinu u roku od 14 dana. Pravo na otkazivanje u roku od 14 dana počinje od dana kada primite, tj. preuzmete artikal. Ako želite da iskoristite svoje 14-dnevno pravo na otkazivanje, nekorišćeni artikal mora da bude vraćen u istom stanju i u istoj količini*. Imajte na umu da delovi narudžbe koji su isporučeni nemontirani, ne smeju da budu montirani. Ako želite da vratite svoj artikal nakon 14 dana, možete da iskoristite našu uslugu zamene. 
			   </p>
			   <p>
			   	Kupovinu možete da otkažete tako što ćete da odbijete da primite, tj. preuzmete narudžbinu ili povraćajem artikla na jedan od sledeća 2 načina: 
			   	<ol>
			   		<li>
			   			Samostalnim povraćajem artikla na adresu naše prodavnice da biste izbegli troškove otpreme. Uradite to ovako: 
			   			<ul>
			   				<li>
			   					Donesite artikal u originalnoj ambalaži/pakovanju* u našu prodavnicu.
			   				</li>
			   				<li>
			   					Nemojte da zaboravite da priložite odštampani primerak/kopiju računa. 
			   				</li>
			   				<li>
			   					Nećete biti odgovorni za plaćanje troškova otpreme vezano uz povraćaj artikla.
			   				</li>
			   			</ul>
			   		</li>
			   		<li>
			   			Povraćajem artikla direktno u našu prodavnicu,  zajedno sa odštampanim primerkom/kopijom računa. Vi ćete biti odgovorni za plaćanje troškova otpreme vezano uz povraćaj artikla. Artikal mora da se vrati na:Kreativni hobi doo,  Novi Beograd
						Prve pruge 37P11070 Beograd.
			   		</li>
			   	</ol>
			   </p>
			   <h5 class="card-title grey-text text-darken-4 ">
					REKLAMACIJE
			   </h5>
			   <p>
			   		Ako je proizvod neispravan ili je oštećen. 
			   </p>
			   <p>
			   		Ako je kupljeni proizvod isporučen neispravan ili oštećen, obratite se korisničkoj službi. 
			   </p>
			   <h5 class="card-title grey-text text-darken-4 ">
					KORISNIČKA SLUŽBA
			   </h5>
			   <p>
			   		Da li imate još pitanja ili Vam je potrebna pomoć? Odgovore na najčešća pitanja pronađite na http://kreativnihobi.com/korisnicka-sluzba/faq ili pišite našo korisničkoj službi popunjavanjem obrasca na http://kreativnihobi.com/kontakt  
			   </p>
			   <p>
			   		Radno vreme Kreativnog hoibija je od ponedeljka do petka 09.00-20.00 sati. Broj telefona za kontakt korisničke službe je 00381 11 319 62 68 
			   </p>
			   <p>
			   		Sve uslove plaćanja i dostave možete pronaći na http://kreativnihobi.com/uslovi-prodaje-i-isporuke
			   </p>
			</div>
      </div>
   </div>
</div>

<!-- @component('mail::button', ['url' => 'http://kreativnihobi.bgsvetionik.com'])
Posetite Nas
@endcomponent -->

Hvala,<br>
{{ config('app.name') }}
@endcomponent
