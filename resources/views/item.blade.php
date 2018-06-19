@extends('layouts.app')


@section('title'){!! $item->name !!} @stop
@section('description'){!! $item->short_description !!} @stop
@section('keywords'){!! $item->belongsTocategory->short_title !!} @stop
@section('og:title'){!! $item->name !!} @stop
@section('og:image'){!! $item->img !!} @stop
@section('og:description'){!! $item->description !!} @stop

@section('style')
<style type="text/css">
.preview-hidden {
    top: 10px;
    position: relative;
}
.color-p{
    max-width: 195px;
    max-height: 40px;
    min-width: 100px;
    position: relative;
   /* margin-bottom: 8px !important;*/
    display: inline-block;
    top: -10px;
}
.color-p i.material-icons{
    position: absolute;
    top: 9px;
    left: 28px;
    color: #fff;
  }
</style>
@endsection

@section('content')
   <nav class="bread">
      <div class="container nav-wrapper">
            <div class="col s12">
              <a href="{{route('proizvodi')}}" class="breadcrumb">Proizvodi</a>

              <a href="{{URL('proizvodi/'.$item->belongsTocategory->id . '/' . $item->belongsTocategory->slug)}}" class="breadcrumb">{{$item->belongsTocategory->short_title}}</a>

@if(isset($item->belongsTosubCat->short_name))
              <a href="{{URL('proizvodi/'.$item->belongsTocategory->id . '/' . $item->belongsTocategory->slug. '/' . $item->belongsTosubCat->id. '/' . $item->belongsTosubCat->slug)}}" class="breadcrumb">{{$item->belongsTosubCat->short_name ? $item->belongsTosubCat->short_name : ''}}</a>
 @endif
              <span class="breadcrumb">{{$item->name}}</span>
            </div>
        </div>
    </nav>
   <!-- SINGLE PRODUCTS -->
    <div class="container single-product" :data-item-id="{{$item->id}}">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="images/{{$item->img}}" alt="{{$item->short_description}}" />
                    </div>
                    <div class="card-stacked"  v-cloak>
                      <div class="card-content">
                        <span class="card-title">{{$item->name}}</span>
                        <p class="card-type">{{$item->belongsTocategory->short_title}}</p>
                        <div class="col s12 m12 l4 p-0"  v-cloak>
                            <p class="price" v-if="color.price">@{{color.price  | formatNumber}} Din</p>
                            <p class="price"  v-if="!color.price">{{$item->price}} Din</p>
                            <p class="pdv">U cenu je uračunat PDV</p>
                            <p class="pdv" v-if="color.code">Code: @{{color.code? color.code : ''}}</p>
                            <p class="color-p" >
                                    <span class="preview-hidden">@{{color.name? color.name : ''}}</span>
                                    <span v-if="color.code"  class="preview" :class="[colorClass]"></span>
                            </p>
                            <p>
                              <a href="javascript:fbshareCurrentPage()" target="_blank"><img src="images/Facebook-share-button.png" alt="Share on Facebook" width="160px" alt="Facebook share button" /></a>
                            </p>
                        </div>
                        <div class="col s12 m12 l8 p-0 item-order">
                              <div class="input-field">
                                  <a class="btn-flat shoping-button" @click="addToBasket({{$item->id}},'{{$item->name}}',color.id)"><i class="material-icons left">add_shopping_cart</i>Dodaj u korpu</a>
                              </div>
                              <div class="input-field">
                                  <a href="javascript:void(0)" class="btn-flat order-button"  onclick="event.preventDefault();document.getElementById('direct-form').submit();"><i class="material-icons left">forward</i>Poruči odmah</a>
                                    <form id="direct-form" action="{{ url('placanje/basketToken') }}" method="POST" style="display: none;">
                                           {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="basketToken" :value="basketToken">
                                        <input type="hidden" name="direct" value="1">
                                        <input type="hidden" name="amount" value="1">
                                        <input type="hidden" name="color" v-bind:value="color.id">
                                    </form>
                              </div>
                            @foreach($parents as $parent)
                                      @if($parent->id == $item->category_id)
                                                @foreach($parent->products as $product)
                                                          @if($product->id == $item->id && $product->colors->count() > 0)
                                                                    <!-- Dropdown Trigger -->
                                                                    <div class="input-field"  v-cloak>

                                                                        <div class="picker-wrapper">
                                                                            <button class="btn btn-default" @click="toggleColor();"><i class="material-icons left">color_lens </i> Izaberite</button>

                                                                            <div class="row relative" v-if="colorShow">
                                                                                <div class="show-canvas center-align">

                                                                                      <ul class="color-picker dd-options dd-click-off-close">

                                                                                            @foreach($product->colors as $color)
                                                          	                                    	<li @click="setColor({{$color}},$event);">
                                                          	                                    		<div class="dd-option waves-effect waves-dark color-topick">
                                                                                                                    <p>
                                                                                                                      <input v-model="color.id" name="Dirt-Devil" id="Devil{{$color->id}}" type="radio"  v-bind:value="{{$color->id}}">
                                                                                                                      <label class="dd-option-text" for="Devil{{$color->id}}">{{$color->name}}</label>
                                                                                                                    </p>
                                                                                                                      <div class="dd-option-image right cc_{{$color->code}}"></div>
                                                                                                                      <p class="color">{{$color->description}}</p>
                                                                                                                      <small class="dd-option-text" >Code: {{$color->code}}</small>
                                                                                                                      @if($color->price)
                                                                                                                      <small class="dd-option-text" >{{$color->price}} Din</small>
                                                                                                                      @endif

                                                                                                                </div>
                                                                                                          </li>
                                                                                              @endforeach
                                                                                     </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        @endif
                                                @endforeach
                                        @endif
                              @endforeach
                        </div>
                      </div>
                      <div class="card-action">
                        <p>{{$item->description}}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  PRODUCTS  -->
         @if($similars[0]->products->count() >0)
    <div class="products">
        <div class="container">
           <div class="title">
                <h1>Slični proizvodi</h1>
                <img src="{{ asset ('images/down-arrow.svg') }}" class="hide-on-small-only" alt="down arrow">
            </div>
        </div>
        <div class="bg-gray">
            <div class="container cards">
                  <div class="cards-product">
                    <div class="row">

                                   @foreach ($similars[0]->products as $similar)
                                                <div class="col s12 m3 l3">
                                                    <div class="card hoverable">
                                                      <div class="card-image">
                                                    <img src="{{asset('images/'.$similar->img)}}" alt="{{$similar->short_description}}" />
                                                      </div>
                                                      <div class="card-content">
                                                          <span class="card-title">{{$similar->name}}</span>
                                                          <p class="card-type">{{$similars[0]->short_title}}</p>
                                                          <!--<p class="old-price">{{$similar->old_price}} RSD</p>-->
                                                          <p class="price">{{$similar->price}} RSD</p>
                                                          <!--<a href="javascript:void(0)" class="btn-flat card-button">Poruči</a>-->
                                                          @if(isset($similar->sub_category_id))
            <a href="proizvodi/{{$similar->category_id}}/novo/{{$similar->sub_category_id}}/odabrani-proizvod/{{$similar->id}}/{{$similar->slug}}" class="btn-flat card-button">Poruči</a>
                                                           @else
            <a href="proizvodi/{{$similar->category_id}}/odabrani-proizvod/kategorija/{{$item->belongsTocategory->slug}}/{{$similar->id}}/{{$similar->slug}}" class="btn-flat card-button">Poruči</a>
                                                          @endif
                                                      </div>
                                                    </div>
                                                </div>
                                   @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
@section( 'script' )

  <script language="javascript">
      function fbshareCurrentPage()
      {window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&t="+document.title, '',
      'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
      return false;

    }
     console.log(document)
  </script>

@endsection