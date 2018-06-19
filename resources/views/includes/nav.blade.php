    <!--- HEADER  -->
    <header>
        <div class="container">
           <div class="row">
             <div class="col s12 m12 l4 center-align logo">
                <a href="{{ route('home') }}"><img src="{{asset('images/kh-logo.svg')}}" alt="Logo" /></a>
             </div>
             <div class="col s12 m12 l8 account hide-on-med-and-down">
              @if (Route::has('login'))
                <div class="data">
                     @auth
                    <a class='dropdown-button grey-text text-darken-1' href='javascript:void(0);' data-activates='profil'>Zdravo,    {{ Auth::user()->first_name }} <span class="caret"></span></a>

                    <!-- Dropdown Structure -->
                    <ul id='profil' class='dropdown-content'>
                      <li><a href="{{ route('profil') }}" class="active grey-text text-darken-1"><i class="material-icons">perm_identity</i> Profil</a></li>
                      <li><a href="{{ route('logout') }}" class="active grey-text text-darken-1" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Izloguj se</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}
                     </form></li>
                    </ul>
                     @else
                    <span class="register">
                      <a href="{{ route('login') }}" >Prijava</a>
                      <a href="{{ route('register') }}">Registracija</a>
                    </span>
                     @endauth
                     <span class="info"><a href="tel:+38111196268">011/319 62 68</a></span>
                </div>
              @endif
                 <div class="shopping-bag hide-on-med-and-down" >
                    <a :href="'korpa/'+ basketToken" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown">
                        <i class="material-icons">shopping_cart</i>  <span class="quantity" v-cloak>@{{count}}</span>
                    </a>
                    <!-- notifications-dropdown -->
                    <ul id="notifications-dropdown" class="dropdown-content" v-if="items.length" >
                        <li class="basket-header">
                          <h6 class="uppercase strong" v-cloak>
                            Vaša korpa @{{!items.length ? 'je prazna !': '(' + items.length + ')' }}
                          </h6>
                        </li>
                        <li class="strong basket-span" v-if="items.length">
                            <span class="col s6">Proizvodi</span>
                            <span class="col s3">Ukloni</span>
                            <span class="col s3">Cena</span>
                        </li>
                        <li v-for="item in items">
                            <div v-for="product in item.item_in_basket" class="col s12 basket-span">
                                <span class="col s6" v-if="product.name" v-cloak>@{{product.name}}</span>
                                <span class="col s2 center-align"><i class="material-icons" @click="deleteItem(product.id)">delete_forever</i></span>
                                <span class="col s4" v-if="product.price" v-cloak>@{{item.price  | formatNumber}} Din</span>
                            </div>
                        </li>
                     </ul>
                    <ul id="notifications-dropdown" class="dropdown-content" v-if="!items.length">
                        <li class="basket-header">
                          <h6 class="uppercase strong" v-cloak>
                            Vaša korpa @{{!items.length ? 'je prazna !': '(' + items.length + ')' }}

                          </h6>
                        </li>
                     </ul>
                  </div>
              </div>
          </div>
      </div>
    </header>
    <!--  NAVIGATION MENU  -->
    <!-- Dropdown Structure -->
    <ul id="dropdown-products" class="dropdown-content collection">
       @if($parents)
           @foreach ($parents as $parent)
                  <li class="collection-item">
                      <a href="{{URL('proizvodi/'.$parent->id.'/'.$parent->slug)}}" class="">{{$parent->short_title}} {{($parent->subCategory->count() > 0) ? "(". $parent->subCategory->count() .")"  : ""}}   {{($parent->products->count() > 0) ? "(". $parent->products->count() .")"  : ""}}</a>
                  </li>
           @endforeach
        @endif
    </ul>
    <nav>
      <div class="container nav-wrapper">
        <div class="right hide-on-large-only">
            <a class="mobil" :href="'korpa/'+ basketToken"><i class="material-icons">shopping_cart</i><span class="quantity" v-cloak>@{{count}}</span></a>
        </div>
       <div class="right search">
          <!--<span class="shopping-bag hide-on-med-and-down"><a href="javascript:void(0)"><i class="material-icons">add_shopping_cart</i></a></span>-->
          <form action="" id="searchform" method="get">
            <a href="javascript:void(0)" @click="toggleSearch()" class="brand-logo right ">
            <i class="material-icons" :class="{'rotate':show}">search</i>
            </a>
            <input id="scale-search" class="scale-search scale-transition scale-out" type="text" name="keyword" placeholder="Pretraga proizvoda..." autocomplete="off">
        </form>
       </div>
       <a href="javascript:void(0)" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="hide-on-med-and-down">
            <li><a class="dropdown-button strong" href="{{ route('proizvodi') }}" data-activates="dropdown-products" data-beloworigin="true">Proizvodi</a></li>
            <li><a href="{{ route('inspiration') }}">Inspiracije i ideje</a></li>
            <li><a href="{{ route('gift') }}">Vaučeri</a></li>
            <li><a class="strong" href="{{ route('novo') }}">Novo</a></li>
            <li><a href="{{ route('contact') }}">Kontakt</a></li>
            <li><a href="{{ route('about') }}">O nama</a></li>
        </ul>
        <ul id="slide-out" class="side-nav">
            <li>

                @guest
                      <!--<div class="user-view">
                             <div class="background">
                                  <img src="{{asset('images/office_default.jpg')}}" alt="Background View">
                            </div>
                                  <a href="javascript:void(0)"><span class="white-text name"> John Doe</span></a>
                      </div>-->
                 @else
                        <div class="user-view">
                          <div class="background">
                                <img src="{{asset('images/office.jpg')}}" alt="Background View">
                          </div>
                                <a href="javascript:void(0)"><span class="white-text name"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></a>
                                <a href="javascript:void(0)"><span class="white-text email"> {{ Auth::user()->email }}</span></a>
                       </div>
                  @endguest


            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header active" data-activates="dropdown-products" data-beloworigin="true">Proizvodi<i class="material-icons">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                          <ul>
                             @if($parents)
                                 @foreach ($parents as $parent)
                                        <li class="collection-item">
                                            <a href="{{URL('proizvodi/'.$parent->id.'/'.$parent->slug)}}" class="">{{$parent->short_title}} ({{$parent->subCategory->count()}})</a>
                                        </li>
                                 @endforeach
                              @endif
                          </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li><a class="waves-effect" href="{{ route('inspiration') }}">Inspiracije i ideje</a></li>
            <li><a class="waves-effect" href="{{ route('gift') }}">Vaučeri</a></li>
            <li><a class="waves-effect" href="{{ route('novo') }}">Novo</a></li>
            <li><a class="waves-effect" href="{{ route('contact') }}">Kontakt</a></li>
            <li><div class="divider"></div></li>
    @guest
            <li><a class="waves-effect" href="{{ route('login') }}">Prijava</a></li>
            <li><a class="waves-effect" href="{{ route('register') }}">Registracija</a></li>
    @else
              <li>
                  <a href="{{ route('profil') }}"><i class="material-icons">perm_identity</i> Profil</a>
            </li>
            <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Izloguj se</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </li>
  @endguest
            <!--<li><a class="waves-effect mobil" :href="'korpa/'+ basketToken"><i class="material-icons">shopping_cart</i><span class="quantity" v-cloak>@{{count}}</span> Korpa </a></li>-->
        </ul>
      </div>
</nav>
