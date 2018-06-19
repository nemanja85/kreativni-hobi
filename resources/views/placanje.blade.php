@extends('layouts.app')
@section('content')
     <!--  PAYMENTS  -->
    <div class="payments">
      <div class="container user">
           <form  id="payments" name="payments" method="POST" action="{{$urlAik}}">
           {{ csrf_field() }}
           <div class="row" v-cloak>
                <div class="col s12 ">
                    <div class="col s12 m12 l6" v-cloak>
                    	<h2>Naručilac</h2>

                    		 <div class="row">
                              	<div class="input-field col s12 m6 l6">
                                  	<a   @click="showCompany =false;" class="btn-basket uppercase legal_entities" :class="{'individuals' : !showCompany}">Fizičko lice</a>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                  	<a  @click="showCompany = !showCompany;" class="btn-basket uppercase legal_entities" :class="{'individuals' : showCompany}">Pravno lice</a>
                                </div>
                            </div>
                                <input type="hidden" name="clientid" value="{{$clientId}}" />
                                @if(isset($amount))
                                <input type="hidden" name="amount" value="{{$amount}}" />
                                @else
                                <input type="hidden" name="amount" :value="total" />
                                @endif

                                <input type="hidden" name="trantype" value="{{$transactionType}}" />
                                <input type="hidden" name="instalment" value="{{$instalment}}" />
                                <input type="hidden" name="oid" value="{{$oid}}" />
                                <input type="hidden" name="okUrl" value="{{$okUrl}}" />
                                <input type="hidden" name="failUrl" value="{{$failUrl}}" />
                                <input type="hidden" name="rnd" value="{{$rnd}}" />
                                <input type="hidden" name="hash" value="{{$hash}}" />
                                <input type="hidden" name="storetype" value="{{$storetype}}" />
                                <input type="hidden" name="lang" value="{{$lang}}" />
                                <input type="hidden" name="currency" value="{{$currencyVal}}" />
                                <input type="hidden" name="refreshtime" value="3" />
                                <input type="hidden" name="encoding" value="utf-8" />
                                <input type="hidden" name="tokenizer" :value="basketToken" />
                              <div v-if="showCompany">
                              	<div class="row">
  	                              	<div class="input-field col s12 m6 l6">
  	                                  	<input placeholder="*Naziv firme:" id="company" name="company" type="text" class="validate" />
  	                                </div>
  	                                <div class="input-field col s12 m6 l6">
  	                                  	<input placeholder="*Pib:" id="pib" name="pib" type="text" class="validate" />
  	                                </div>
                             	 	</div>
  	                            <div class="row">
  	                              	<div class="input-field col s12 m6 l6">
  	                                  	<input placeholder="*Matični broj:" id="mat_number" name="mat_number" type="email" class="validate" />
  	                                </div>
  	                                <div class="input-field col s12 m6 l6">
  	                                  	<input placeholder="Račun uplatioca:" id="company-account" name="company-account" type="text" />
  	                                </div>
  	                            </div>
                            </div>
                               @guest
                    		    <div class="row">
                              	<div class="input-field col s12 m6 l6">
                                  	<input v-model='user.ShipToName' placeholder="*Ime i Prezime" id="first_name" name="BillToName" type="text" class="validate" value="{{old('first_name' )}}">
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="*E-mail adresa:" id="email" name="email" type="email" class="validate" value="{{old('email')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                  	<input placeholder="Telefon:" id="phone" name="phone" type="text" class="validate" value="{{old('phone' )}}">
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input v-model='user.ShipToStreet1' placeholder="*Adresa:" id="address" name="BillToStreet1" type="text" class="validate" value="{{  old('BillToStreet1') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                  	<input v-model='user.ShipToCity' placeholder="*Grad:" id="city" name="BillToCity" type="text" class="validate" value="{{ old('BillToCity')}}">
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input v-model='user.ShipToPostalCode' placeholder="*Poštanski broj:" id="postal_code" name="BillToPostalCode" type="text" class="validate" value="{{ old('BillToPostalCode')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input  v-model='user.ShipToCountry' placeholder="*Zemlja:" id="country" name="BillToCountry"  type="text" class="validate" value="{{ old('BillToCountry')}}">
                                </div>
                            </div>
                                @else
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="*Ime i Prezime:" id="first_name" name="BillToName" type="text" class="validate" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="*E-mail adresa:" id="email" name="email" type="email" class="validate" value="{{Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Telefon:" id="phone" name="phone" type="text" class="validate" value="{{Auth::user()->phone}}">
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="*Adresa:" id="address" name="BillToStreet1" type="text" class="validate" value="{{Auth::user()->address }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="*Grad:" id="city" name="BillToCity" type="text" class="validate" value="{{Auth::user()->city}}">
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input  placeholder="*Poštanski broj:" id="postal_code" name="BillToPostalCode" type="text" class="validate" value="{{Auth::user()->zip}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input  placeholder="*Zemlja:" id="country" name="BillToCountry" type="text" class="validate" value="{{Auth::user()->country}}">
                                </div>
                            </div>
                            @endguest
                           @guest
                            <div class="row">
                              	<div class="input-field col s12 m6 l6">
                                  	<input placeholder="*Lozinka:" id="password" name="password" type="password" class="validate" />
                                </div>
                                <div class="input-field col s12 m6 l6">
                                  	<input placeholder="*Ponovi lozinku:" id="password_confirmation" name="password_confirmation" type="password" class="validate" />
                                </div>
                            </div>
                             @endguest

                             <h2>Dostava</h2>
    <p>
    <input type="checkbox" id="test5" v-model='guest' @click="ifGuest();"/>
    <label for="test5">Ukoliko želite da koristite istu adresu za dostavu.</label>
    </p>
                        <div v-if='guest'>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Ime i Prezime kome se šalje:" name="ShipToName" type="text" :value="user.ShipToName" class="validate" />
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Adresa na koju se šalje:" name="ShipToStreet1" type="text" :value="user.ShipToStreet1" class="validate" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Grad u koji se šalje:" name="ShipToCity" type="text" :value="user.ShipToCity" class="validate" />
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Poštanski broj:"  name="ShipToPostalCode" type="text" :value="user.ShipToPostalCode" class="validate" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Zemlja u koju se šalje:" name="ShipToCountry" type="text" :value="user.ShipToCountry" class="validate" />
                                </div>
                            </div>
                        </div>

                        <div v-if='!guest'>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Ime i Prezime kome se šalje:" name="ShipToName" type="text" value="" class="validate" />
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Adresa na koju se šalje:" name="ShipToStreet1" type="text" value="" class="validate" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Grad u koji se šalje:" name="ShipToCity" type="text" value="" class="validate" />
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Poštanski broj:"  name="ShipToPostalCode" type="text" value="" class="validate" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Zemlja u koju se šalje:" name="ShipToCountry" type="text" value="" class="validate" />
                                </div>
                            </div>
                        </div>
                            <h2>Napomena</h2>
                            <div class="row">
                            	<div class="input-field col s12 m12 l12">
                            		<textarea name="notice" id="textarea1" class="materialize-textarea" placeholder="U koliko imate neki zahtev...."></textarea>
                            	</div>
                            </div>
                            @if(isset($vaucer) && !empty($vaucer))

                            <h2>Vaučer</h2>
                            <h6>Vaučer može iskoristiti samo lice na koje glasi vaučer uz potrebnu indentifikaciju!</h6>
                            <h6>Na Robu kupljenu Vaučerom ne može se iskoristiti pravo na povraćaj robe!</h6>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="Ime i prezime :" id="vaucer-ime" name="vaucer-ime" type="text" class="validate" />
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input placeholder="E-mail adresa:" id="vaucer-mail" name="vaucer-mail" type="email" class="validate" />
                                </div>
                            </div>

                            @endif
                    </div>
                    <div class="col s12 m12 l5 offset-l1">
                    	<h2>Vaša porudžbina</h2>
                    	<table class="bordered strong">
                            <thead>
                                <tr>
                                    <td>Proizvodi</td>
                                    <td class="center-align">Ukloni</td>
                                    <td class="center-align">Količina</td>
                                    <td class="right-align">Cena</td>
                                </tr>
                            </thead>
                            <tbody v-if="items.length" class="vue">
	                               <tr v-for="(item,index) in items" v-cloak>
                                    <input type="hidden" name="printBillTo" value="true">
                                    <input type="hidden" name="printShipTo" value="true">
                                    <input type="hidden" :name="'ItemNumber_' + item.item_in_basket[0].id" :value="item.item_in_basket[0].id">
                                    <input type="hidden" :name="'ProductCode_' + item.item_in_basket[0].id" :value="item.item_in_basket[0].id">
                                    <input type="hidden" :name="'Qty_' + item.item_in_basket[0].id" :value="item.amount">
                                    <input type="hidden" :name="'Desc_' + item.item_in_basket[0].id" :value="item.item_in_basket[0].name" />
                                    <input type="hidden" :name="'Id_' + item.item_in_basket[0].id" :value="item.item_in_basket[0].id">
                                    <input type="hidden" :name="'Price_' + item.item_in_basket[0].id" :value="item.price" />
                                    <input type="hidden" :name="'Total_' + item.item_in_basket[0].id" :value="(item.amount * item.price) ">
	                                  <td>@{{item.item_in_basket[0].name}}</td>
	                                  <td class="center-align"><i class="material-icons" @click="deleteItem(item.item_in_basket[0].id);">delete</i></td>
                                         <td class="center-align">@{{item.amount}}</td>
	                                  <td class="right-align">@{{item.price | formatNumber }} Din</td>
	                              </tr>
                            </tbody>

                            <tbody v-if="!items.length" class="php">
                    @if(isset($allInBaskets))
                                   @foreach ($allInBaskets as $item)
                                 <tr v-cloak>

                                  <input type="hidden" name="printBillTo" value="true">
                                  <input type="hidden" name="ItemNumber_{{$item->ItemInBasket[0]->id}}" value="{{$item->ItemInBasket[0]->id}}">
                                  <input type="hidden" name="ProductCode_{{$item->ItemInBasket[0]->id}}" value="{{$item->ItemInBasket[0]->id}}">
                                  <input type="hidden" name="Qty_{{$item->ItemInBasket[0]->id}}" value="{{$item->amount}}">
                                  <input type="hidden" name="Desc_{{$item->ItemInBasket[0]->id}}" value="{{$item->ItemInBasket[0]->name}}">
                                  <input type="hidden" name="Id_{{$item->ItemInBasket[0]->id}}" value="{{$item->ItemInBasket[0]->id}}">
                                  <input type="hidden" name="Price_{{$item->ItemInBasket[0]->id}}" value="{{$item->ItemInBasket[0]->price}}">
                                  <input type="hidden" name="Total_{{$item->ItemInBasket[0]->id}}" value="{{$item->amount}}">


                                    <td>{{$item->ItemInBasket[0]->name}}</td>
                                    <td class="center-align"><i class="material-icons" @click="deleteItem({{$item->ItemInBasket[0]->id}})">delete</i></td>
                                         <td class="center-align">{{$item->amount}}</td>
                                    <td class="right-align">{{$item->price }} Din</td>
                                </tr>
                                  @endforeach
                            </tbody>
                            <tfoot >
	                              <tr>
	                                  <td colspan="3">Ukupno</td>
	                                  <td class="subtotal  right-align">{{$amount}} Din</td>
	                              </tr>
	                              <tr>
	                                  <td colspan="3">PDV  20%</td>
	                                  <td class="pdv  right-align">{{$pdv}} Din</td>
	                              </tr>
	                              <tr class="strong">
	                                  <td colspan="3">Za uplatu</td>
	                                  <td class="total right-align">{{$amount}} Din</td>
	                              </tr>
                            </tfoot>
                      @endif
                            <tfoot  v-if="items.length" >
                                  <tr>
                                      <td colspan="3">Ukupno</td>
                                      <td class="subtotal  right-align">@{{sumare  | formatNumber}} Din</td>
                                  </tr>
                                  <tr>
                                      <td colspan="3">PDV - 20%</td>
                                      <td class="pdv  right-align">@{{pdv  | formatNumber}} Din</td>
                                  </tr>
                                  <tr class="strong">
                                      <td colspan="3">Za uplatu</td>
                                      <td class="total right-align">@{{total | formatNumber}} Din</td>
                                  </tr>
                            </tfoot>
                        </table>
                        <h3>Izaberite način plaćanja</h3>
                        <ul class="collapsible" data-collapsible="accordion">
                              <li :class="{'active':!showCompany}" id="aik">
                          	<div class="collapsible-header">
                                        <a href="javascript:void(0);" class="btn-basket uppercase">
                                            Aik Banka
                                        </a>
                                  </div>
                                <div class="collapsible-body">
                                      <img src="images/aik-logo-green.png" alt="aik logo green" />
                                      <p></p>
                                      <div class="payments-cards pb-20">
                                          <img src="images/visa-mastercard.png" alt="visa mastercard" />
                                          <img src="images/visa_mastercard_secure_code.png" alt="visa mastercard secure code" />
                                      </div>
                                        @if(isset($active))
                                      <div class="col s12 p-0">
                                          <button  class="pay-now btn right uppercase" @click="sendForm();"
                                          :class="{'disabled': (!user.ShipToName || !user.ShipToPostalCode ||
                                           !user.ShipToStreet1 || !user.ShipToCity || !user.ShipToCountry)}">Plati sad</button>
                                      </div>
                                      @else
                                      <div class="col s12 p-0">
                                          <button class="pay-now btn right" @click="sendForm();"
                                           :class="{'disabled': (!user.ShipToName || !user.ShipToPostalCode ||
                                           !user.ShipToStreet1 || !user.ShipToCity || !user.ShipToCountry)}">Plati sad</button>
                                      </div>
                                      @endif
                                  </div>
                              </li>
                      	      <li v-if="!showCompany" id="personal">
                          	       <div class="collapsible-header">
                                          <a href="javascript:void(0);" id="payment-slip" class="btn-basket uppercase">
                                              Uplatnica
                                          </a>
                                  </div>
                                  @guest
                                  <div class="collapsible-body">
                                      <div class="slips payment-slip">
                                          <span class="user-data">Ime Prezime, Adresa, Grad</span>
                                          <span class="purpose">Online kupovina</span>
                                          <span class="recepient">Kreativni hobi doo, Prve pruge 37P,<br/>11080 Zemun, Beograd</span>
                                          <span class="code">221</span>
                                          <span class="currency">RSD</span>
                                          <span class="amount">@{{total | formatNumber}}</span>
                                          <span class="acc-personal">105-13294-14</span>
                                          <span class="approval-personal">170-0030029599000-59</span>
                                      </div>
                                      <div class="pdf hide-on-med-and-down">
                                          <a  href="javascript:void(0);" class="pay-now btn uppercase">
                                          <i class="material-icons">picture_as_pdf</i>
                                          Štampaj</a>
                                          <a  href="javascript:void(0);" class="pay-now btn right uppercase right"
                                          :class="{'disabled':(!user.ShipToName || !user.ShipToPostalCode ||
                                           !user.ShipToStreet1 || !user.ShipToCity || !user.ShipToCountry)}"
                                          @click="sendMail();">
                                            <i class="material-icons">mail_outline</i>
                                             Naruči</a>
                                      </div>
                                  </div>
                                  @else
                                                                    <div class="collapsible-body">
                                      <div class="slips payment-slip">
                                          <span class="user-data">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}, {{ Auth::user()->address }},  {{ Auth::user()->city }}</span>
                                          <span class="purpose">Online kupovina</span>
                                          <span class="recepient">Kreativni hobi doo, Prve pruge 37P,<br/>11080 Zemun, Beograd</span>
                                          <span class="code">221</span>
                                          <span class="currency">RSD</span>
                                          <span class="amount">@{{total | formatNumber}}</span>
                                          <span class="acc-personal">105-13294-14</span>
                                          <span class="approval-personal">170-0030029599000-59</span>
                                      </div>
                                      <div class="pdf hide-on-med-and-down">
                                          <a  href="javascript:void(0);" class="pay-now btn uppercase">
                                          <i class="material-icons">picture_as_pdf</i>
                                          Štampaj</a>
                                         <a  href="javascript:void(0);" class="pay-now btn right uppercase right"
                                          :class="{'disabled':(!user.ShipToName || !user.ShipToPostalCode ||
                                           !user.ShipToStreet1 || !user.ShipToCity || !user.ShipToCountry)}"
                                          @click="sendMail();">
                                             Naruči</a>
                                      </div>
                                  </div>
                                  @endguest
                              </li>
                              <li v-if="showCompany" id="company">
                                  <div class="collapsible-header">
                                      <a href="javascript:void(0);" id="transfer-order" class="btn-basket uppercase">
                                      Nalog za prenos
                                      </a>
                                  </div>
                                  <div class="collapsible-body">
                                  @guest
                                      <div class="slips transfer-order">
                                          <span class="user-data">Ime Prezime, Adresa, Grad</span>
                                          <span class="purpose">Online kupovina</span>
                                          <span class="recepient">Kreativni hobi doo, Prve pruge 37P,<br/>11080 Zemun, Beograd</span>
                                          <span class="code">221</span>
                                          <span class="currency">RSD</span>
                                          <span class="company-account">220-0000004854-90</span>
                                          <span class="amount">@{{total | formatNumber}}</span>
                                          <span class="acc-personal">105-13294-14</span>
                                          <span class="approval-personal">170-0030029599000-59</span>
                                      </div>
                                    @else
                                        <div class="slips transfer-order">
                                          <span class="user-data">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}, {{ Auth::user()->address }},  {{ Auth::user()->city }}</span>
                                          <span class="purpose">Online kupovina</span>
                                          <span class="recepient">Kreativni hobi doo, Prve pruge 37P,<br/>11080 Zemun, Beograd</span>
                                          <span class="code">221</span>
                                          <span class="currency">RSD</span>
                                          <span class="company-account">220-0000004854-90</span>
                                          <span class="amount">@{{total | formatNumber}}</span>
                                          <span class="acc-personal">105-13294-14</span>
                                          <span class="approval-personal">170-0030029599000-59</span>
                                      </div>
                                      @endguest
                                      <div class="pdf hide-on-med-and-down">
                                          <a  href="javascript:void(0);" class="pay-now btn uppercase">
                                          <i class="material-icons">picture_as_pdf</i>
                                          Štampaj</a>
                                          <a  href="javascript:void(0);" class="pay-now btn right uppercase right"
                                          :class="{'disabled':(!user.ShipToName ||!user.ShipToPostalCode ||
                                           !user.ShipToStreet1 || !user.ShipToCity || !user.ShipToCountry)}"
                                          @click="sendMail();">
                                            <i class="material-icons">mail_outline</i>
                                             Naruči</a>
                                      </div>
                                  </div>
                            	</li>
        		            </ul>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div id="bill_personal" class="container" style="display: none;">
        <div class="row uplatnica-holder">
            <h2>Va&scaron; porudžbina je uspe&scaron;no zavr&scaron;ena.</h2>
            <h4>
                <br/>
                Podaci o porudžbini &#263;e Vam biti proslati na  E-mail  koji ste naveli u upitu.
            </h4>
            <div  class="person">
                <h3>Opšta uplatnica</h3>
                <div class="col s12 m12 l12">
                    <div class="slips payment-slip">
                        <img src="{{ asset('images/personal.jpg') }}"  width="620" alt="Uplatnica"/>
                        <span class="user-data"></span>
                        <span class="purpose">Online kupovina </span>
                        <span class="recipient">
                            Kreativni hobi doo Beograd,<br/>
                            Prve Pruge 37P
                        </span>
                        <span class="code">221</span>
                        <span class="currency">RSD</span>
                        <span class="amount">2 280.00</span>
                        <span class="acc-personal">105-13294-14</span>
                        <span class="model-personal">97</span>
                        <span class="approval-personal">170-0030029599000-59</span>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div id="bill_company" class="container" style="display: none;">
          <div class="row uplatnica-holder">
              <h2>Va&scaron; porudžbina je uspe&scaron;no zavr&scaron;ena.</h2>
              <h4>
                  <br/>
                  Podaci o porudžbini &#263;e Vam biti proslati na E-mail koji ste naveli u upitu.
              </h4>
              <div class="company">
                  <h3>Nalog za prenos</h3>
                  <div class="col s12 m12 l12">
                      <div class="nalog-text" style="font-family: 'Raleway', sans-serif;position: relative;left: 0;font-size: 1.26rem;height: 320px;background-repeat: no-repeat;margin: 20px auto;text-align: left;">
                          <div class="slips transfer-order">
                              <img src="{{ asset('images/company.jpg') }}"  width="620" alt="Nalog za prenos"/>
                              <span class="user-data" style="display: block;left: 34px;position: absolute;top: 36px;height: 24px;"></span>
                              <span class="purpose" style="display: block;left: 35px;position: absolute;top: 65px;">Online kupovina </span>
                              <span class="recipient" style="display: block;left: 35px;position: absolute;top: 95px;">
                                Kreativni hobi doo Beograd,<br/>
                                Prve Pruge 37P
                              </span>
                              <span class="code" style="display: block;position: absolute;top: 42px;right: 276px;line-height: 1;">221</span>
                              <span class="currency" style="display: block;position: absolute;top: 42px;right: 250px;line-height: 1;">RSD</span>
                              <span class="amount" style="display: block;position: absolute;top: 42px;right: 171px;line-height: 1;">2 280.00</span>
                              <span class="acc-company" style="display: block;position: absolute;top: 61px;right: 183px;line-height: 1;">170-0030029599000-59</span>
                              <span class="model-company" style="display: block;position: absolute;top: 79px;right: 281px;line-height: 1;">97</span>
                              <span class="approval-company" style="display: block;position: absolute;top: 79px;right: 174px;line-height: 1;">170-0030029599000-59</span>
                              <span class="acc" style="display: block;position: absolute;top: 97px;right: 183px;line-height: 1;">170-0030029599000-59</span>
                              <span class="model" style="display: block;position: absolute;top: 116px;right: 281px;line-height: 1;">97</span>
                              <span class="approval" style="display: block;position: absolute;top: 116px;right: 174px;line-height: 1;">170-0030029599000-59</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
@section( 'script' )

@endsection
