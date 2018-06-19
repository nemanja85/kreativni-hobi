<?php $__env->startSection('style'); ?>
<style type="text/css">
h5 {
    font-size: 1.333rem;
}
i.close-icon {
    margin-left: 0;
    top: 7px;
    position: relative;
}
.m-bt{
  margin: 5px 0;
}
.mt-50{
    margin-top: 50px;
}
.invoice-brief{
      min-height: 94px !important;
}
.pth-10{
      padding: 0 10px;
}
.pay-now{
  margin: 20px 0;
}

.invoice-bg{
    background: #f1f1f1;
    margin-bottom: 25px;
        padding-bottom: 50px !important;
}
.task-cat {
    padding: 2px 4px;
    color: #fff;
    font-weight: 300;
    font-size: 0.8rem;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    background-clip: padding-box;
}
.overflow-y{
    overflow-y: auto;
    height: 335px;
}
.btn {
    border: 1px solid #630460;
    color: #630460;
    }
i.material-icons.top {
    top: 5px;
    position: relative;
}
table.bordered>tbody>tr:last-child{
    border-bottom: none;
}
.orange{
    background-color: #f5943e!important;
}
.gradient-45deg-red-pink {
    background: #FF5252;
    background: -webkit-linear-gradient(45deg, #FF5252 0%, #f48fb1 100%);
    background: linear-gradient(45deg, #FF5252 0%, #f48fb1 100%);
}
.gradient-45deg-green-teal {
    background: #43A047;
    background: -webkit-linear-gradient(45deg, #43A047 0%, #1de9b6 100%);
    background: linear-gradient(45deg, #43A047 0%, #1de9b6 100%);
}
#map.google-map{
    height: 325px;
    margin-top: 5px;
}
figure.card-profile-image h2{
text-align: center;
    display: block;
    border-radius: 50%;
    color: white;
    width: 85px;
    height: 85px;
    line-height: 85px;
    }
i.material-icons.font-violet, .profil i.material-icons {
    top: 5px;
    position: relative;
}
.gradient-45deg-light-blue-cyan.gradient-shadow {
    box-shadow: 0 6px 20px 0 rgba(99, 4, 96, 0.5)
}
#password, #confirmPassword{
  display: block !important;
}
#changePassword{
    overflow: hidden;
}
#profile-page-header{
      min-height: 325px;
}
.card .card-reveal {
    padding: 0;
    position: absolute;
    background-color: #fff;
    width: 100%;
    overflow-y: auto;
    left: 0;
    top: 100%;
    height: 100%;
    z-index: 3;
    display: none;
}
#profile-page-header .card-profile-image {
    width: 110px;
    position: absolute;
    top: 180px;
    z-index: 1;
    left: 40px;
    cursor: pointer;
    margin: 0;
}
.profile .indicator {
    display: block;
}
.bg-violet {
    background-color: #630460 !important;
}
.bg-v{
    background: #763cda;
    background: -webkit-linear-gradient(45deg, #630460 0%, #7c4dff 100%);
    background: linear-gradient(45deg, #630460 0%, #7c4dff 100%);
}
.tabs .indicator {
    background-color: #ffffff;
}
.invoice-lable h4{
   margin: 26px;
    }
.invoice-lable button {
    float: right;
    margin: 30px 0;
}
.profile .tab {    border-bottom: none;
}
.shoping-bag table.bordered>tbody>tr, table.bordered>thead>tr {
    border-bottom: 1px solid #630460;
}
#profile-page-header .card-image {
    height: 250px;
}
.p-lr-24 {
  padding: 0 24px !important;
}
.p-lr-24-map {
padding: 0 5px !important;
}
#AddPhotos td, th {
    text-align: center;
}
    .green {
    background-color: #4CAF50 !important;
}
.aik-response{
    padding: 50px 0;
}
#alert_box{    margin-top: 20px;}
#alert_box .card-content {
    padding: 10px 20px;
}
#alert_box button {
    background: none;
    border: none;
    position: absolute;
    top: 5px;
    right: 10px;
    font-size: 20px;
    color: #fff;
}
.min-43 {
  min-height: 43.6vh !important;
}
 @media  screen and (min-width: 768px) and (max-width: 1024px) {
      #map.google-map {
          height: 358px;
          margin-top: 5px;
      }
}
 @media  screen and (max-width: 600px) {
      #AddPhotos .card-title{
            padding: 0 10px;
      }
      table.responsive-table{
            padding: 0 5px;
      }
      h5.header {
    font-size: 1.58rem;
}
      .invoice h4.card-title, .invoice h5.card-title{
            font-size: 18px;
      }
      .invoice-header{
          padding: 0 10px;
      }
      h5.card-title.grey-text.text-darken-4.mt-50
      #profile-page-header{
            min-height: 325px;
                height: 623px;
      }
      .invoice{
        text-align: center;;
      }
      .overflow-y {
          overflow-y: auto;
          height: auto;
      }
      .invoice-lable button {
          float: none;
      }
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- PROFILE -->
<?php if(isset($formatedResponse)): ?>
        <div class="row">
           <div class="col s12 m8 offset-m2">
               <div id="alert_box" class="card green scale-transition scale-out">
                    <div class="card-content white-text">
                      <span class="card-title white-text darken-1 notifi">
                        <i class="material-icons">notifications_active</i> <?php echo e($formatedResponse['Response'] == 'Approved' ? 'Transakcija je uspešno izvršena.' : ''); ?></span>


                    </div>
                    <button type="button" class="close white-text" @click="closeAlert();">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                </div>
              </div>
  <?php endif; ?>
<div class="container profile">
   <div class="row">
      <div class="col s12 m12 l12" v-cloak>
         <div id="profile" class="col tab-content user-data">
            <div id="profile-page-header" class="card">
               <div class="card-image waves-effect waves-block waves-light" >
                  <img class="activator bg -v" src="<?php echo e(asset('/images/avatar/user-bg.png')); ?>" alt="user background">
               </div>
               <figure class="card-profile-image">
                 <!-- <img src="<?php echo e(asset('/images/avatar/avatar-7.png')); ?>" alt="profile image" class="circle z-depth-2 responsive-img activator gradient-45deg-light-blue-cyan gradient-shadow">-->
                   <h2 @click="userMap();" class="circle z-depth-2 responsive-img activator gradient-45deg-light-blue-cyan gradient-shadow bg-v"><?php echo e(substr(Auth::user()->first_name, 0, 1)); ?><?php echo e(substr(Auth::user()->last_name, 0, 1)); ?></h2>
               </figure>
               <div class="card-content">
                  <div class="row pt-2">
                     <div class="col s12 m3 offset-m2">
                        <h4 class="card-title grey-text text-darken-4" > <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></h4>
                        <p class="medium-small grey-text"><?php echo e(Auth::user()->email); ?></p>
                     </div>
                     <!--<div class="col s12 m3 center-align">
                        <h4 class="card-title grey-text text-darken-4">10+</h4>
                        <p class="medium-small grey-text">Work Experience</p>
                     </div>-->
                     <div class="col s12 m3 center-align">
                        <h4 class="card-title grey-text text-darken-4"> <i class="material-icons top">add_shopping_cart</i> <?php echo e($amount); ?></h4>
                        <p class="medium-small grey-text">Proizvoda Kupljeno</p>
                     </div>
                     <div class="col s12 m3 center-align">
                        <h4 class="card-title grey-text text-darken-4"><?php echo e($sum); ?> Din</h4>
                        <p class="medium-small grey-text">Ukupno Utrošeno</p>
                     </div>
                     <div class="col s12 m1 right-align">
                        <a class="btn-floating activator waves-effect waves-light rec bg-v right" @click="userMap();">
                        <i class="material-icons">settings</i>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="card-reveal">
                  <ul class="tabs tab-profile z-depth-1 bg-violet profil">
                     <li class="tab col s6">
                        <a class="white-text waves-effect waves-light active" href="#UpdateStatus">
                        <i class="material-icons">perm_identity</i> Profil</a>
                     </li>
                     <li class="tab col s6">
                        <a class="white-text waves-effect waves-light" href="#AddPhotos">
                        <i class="material-icons">add_shopping_cart</i> Transakcije</a>
                     </li>
                    <!-- <li class="tab col s4">
                        <a class="white-text waves-effect waves-light" href="#CreateAlbum">
                        <i class="material-icons">border_color</i>  Promena</a>
                     </li>-->
                     <li class="indicator"></li>
                  </ul>
                  <div id="UpdateStatus" class="tab-content col s12 p-lr-24-map">
                  <div class="col s12 m5">
                     <p>
                        <span class="card-title grey-text text-darken-4"> <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?>

                        <i class="material-icons right">close</i>
                        </span>
                     </p>
                     <p>
                        <i class="material-icons font-violet">perm_phone_msg</i> <?php echo e(Auth::user()->phone); ?>

                     </p>
                     <p>
                        <i class="material-icons font-violet">email</i> <?php echo e(Auth::user()->email); ?>

                     </p>
                     <p>
                        <i class="material-icons font-violet">location_on</i> <?php echo e(Auth::user()->address); ?>

                     </p>
                     <p>
                        <i class="material-icons font-violet">language</i> <?php echo e(Auth::user()->country); ?>, <?php echo e(Auth::user()->city); ?>, <?php echo e(Auth::user()->zip); ?>

                     </p>
                  </div>
                  <div id="map" class="col s12 m7 google-map"></div>
                  </div>
                  <div id="AddPhotos" class="tab-content col s12 overflow-y">
                <p><span class="card-title grey-text text-darken-4"> Status vaših kupovina
                        <i class="material-icons right">close</i></span></p>
                     <table class="responsive-table highlight bordered">
                        <thead>
                           <tr>
                              <th colspan="2">Proizvod</th>
                              <th>Cena</th>
                              <th>količina</th>
                              <th>Datum</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if($parents): ?>
                           <?php $__currentLoopData = $allInBaskets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $basket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           	<?php if($basket->response != 'Approved'): ?>
                           <tr @click="showInvoice(<?php echo e($basket); ?>,<?php echo e($allInBaskets); ?>)">
                              <td colspan="2"> <?php echo e($basket->ItemInBasket[0]->name); ?></td>
                              <td><?php echo e($basket->ItemInBasket[0]->price); ?> Din</td>
                              <td><?php echo e($basket->amount); ?> <?php echo e($basket->ItemInBasket[0]->amount); ?></td>
                              <td><?php echo e($basket->created_at); ?></td>
                              <td><span class="task-cat red lighten-1"><?php echo e($basket->response == 'Declined' ? 'Odbijeno' : 'Ponisteno'); ?></span></td>
                           </tr>
                           	<?php else: ?>
                           <tr  @click="showInvoice(<?php echo e($basket); ?>,<?php echo e($allInBaskets); ?>)">
                              <td colspan="2"> <?php echo e($basket->ItemInBasket[0]->name); ?></td>
                              <td><?php echo e($basket->ItemInBasket[0]->price); ?> Din</td>
                                <td><?php echo e($basket->amount); ?> <?php echo e($basket->ItemInBasket[0]->amount); ?></td>
                              <td><?php echo e($basket->created_at); ?></td>
                                      <td><span class="task-cat green lighten-1"><?php echo e($basket->response == 'Approved' ? 'Odobreno' : $basket->response); ?></span></td>
                           </tr>
                           	<?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>
                        </tbody>
                     </table>
                     <div class="col s12 m12 invoice invoice-bg left-align" v-if="invoice" v-cloak="invoice">
                      <h4 class="card-title grey-text text-darken-4  mt-50">Zahvaljujemo Vam se na narudžbini </h4>
                     <h5 class="card-title grey-text text-darken-4 ">
                     Potvrda vaše narudžbine putem broja narudžbine: {{invoice}}
                     </h5>
                          <div id="invoice" class="">
                              <div class="invoice-header">
                                  <div class="row section">
                                    <div class="col s12 m4 l4 left-align">
                                    <h5 class="grey-text text-darken-4">Adresa plaćanja</h5>
                                        <span class="invoice-icon">
                                          <i class="material-icons font-violet">perm_identity</i>
                                        </span>
                                        <p class="name m-bt"><span class="strong">Ime:</span> <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></p>
                                        <p class="address m-bt"><span class="strong">Adresa:</span> <?php echo e(Auth::user()->address); ?></p>
                                          <p class="city m-bt"><span class="strong">Grad:</span> <?php echo e(Auth::user()->city); ?></p>
                                          <p class="postal_code m-bt"><span class="strong">Poštanski kod:</span> <?php echo e(Auth::user()->zip); ?></p>
                                          <p class="country m-bt"><span class="strong">Zemlja:</span> <?php echo e(Auth::user()->country); ?></p>
                                          <p class="phone m-bt"><span class="strong">Tel:</span> <?php echo e(Auth::user()->phone); ?></p>
                                      <div class="invoce-company-contact">
                                        <span class="invoice-icon">
                                          <i class="material-icons font-violet">mail_outline</i>
                                        </span>
                                        <p class="m-bt">
                                          <span class="mail"><span class="strong">E-mail:</span> <?php echo e(Auth::user()->email); ?></span>
                                        </p>
                                      </div>
                                    </div>
                                     <div class="col s12 m4 l4 left-align">
                                    <h5 class="grey-text text-darken-4">Adresa isporuke</h5>
                                        <span class="invoice-icon">
                                          <i class="material-icons font-violet">perm_identity</i>
                                        </span>
                                        <p class="name m-bt"><span class="strong">Ime:</span> <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></p>
                                        <p class="address m-bt"><span class="strong">Adresa:</span> <?php echo e(Auth::user()->address); ?></p>
                                          <p class="city m-bt"><span class="strong">Grad:</span> <?php echo e(Auth::user()->city); ?></p>
                                          <p class="postal_code m-bt"><span class="strong">Poštanski kod:</span> <?php echo e(Auth::user()->zip); ?></p>
                                          <p class="country m-bt"><span class="strong">Zemlja:</span> <?php echo e(Auth::user()->country); ?></p>
                                          <p class="phone m-bt"><span class="strong">Tel:</span> <?php echo e(Auth::user()->phone); ?></p>
                                      <div class="invoce-company-contact">
                                        <span class="invoice-icon">
                                          <i class="material-icons font-violet">mail_outline</i>
                                        </span>
                                        <p class="m-bt">
                                          <span class="mail"><span class="strong">E-mail:</span> <?php echo e(Auth::user()->email); ?></span>
                                        </p>
                                      </div>
                                    </div>
                                    <div class="col s12 m4 l4">
                                      <div class="invoce-company-address right-align">
                                        <span class="invoice-icon">
                                          <i class="material-icons font-violet">location_city</i>
                                        </span>

                                          <p class="strong m-bt">Kreativni Hobi doo</p>

                                          <p class="m-bt">Prve pruge 37P - Zemun</p>

                                          <p class="m-bt">011/319-62-58</p>

                                      </div>
                                      <div class="invoce-company-contact right-align">
                                        <span class="invoice-icon">
                                          <i class="material-icons font-violet">mail_outline</i>
                                        </span>
                                        <p class="m-bt">
                                          <span>prodaja@kreativnihobi.com</span>
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
<table class="responsive-table highlight bordered">
                        <thead>
                           <tr>
                              <th colspan="2">Proizvod</th>
                              <th>Cena</th>
                              <th>količina</th>
                              <th>Datum</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(invItem, index) in invItems" :index="index">
                              <td colspan="2"> {{invItem.item_in_basket[0].name}}</td>
                              <td>{{invItem.price | formatNumber}} Din</td>
                              <td>{{invItem.amount}} {{invItem.item_in_basket[0].amount}}</td>
                              <td>{{invItem.created_at}}</td>
                              <td v-if="(invItem.response == 'Declined')"><span class="task-cat red lighten-1">Odbijeno</span></td>
                              <td v-if="(invItem.response == 'Approved')"><span class="task-cat green lighten-1">Odobreno</span></td>
                              <td v-if="(invItem.response == 'Canceled')"><span class="task-cat orange lighten-1">Poništeno</span></td>
                           </tr>
                        </tbody>
                     </table>

                                    <div class="row">
                                        <div class="col s12 m12 l3 bg-violet font-white invoice-brief">
                                            <h4 class="invoice-text">Račun</h4>
                                        </div>
                                        <div class="col s12 m12 l9 invoice-brief bg-violet font-white">
                                            <div class="row">
                                                <div class="col s12 m4 l4 invoice-brief">
                                                    <p class="font-white strong">Ukupno sa PDV 20%</p>
                                                    <h5 class="header">{{invSum | formatNumber}} Din</h5>
                                                </div>
                                                <div class="col s12 m4 l4 invoice-brief">
                                                   <p class="font-white strong">Broj računa</p>
                                                    <h5 class="header">{{invoice}}</h5>
                                                </div>
                                                <div class="col s12 m4 l4 invoice-brief">
                                                    <p class="font-white strong">Datum</p>
                                                    <h5 class="header">{{invDate}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 p-0 center-align" v-if="(invItems[0].response !== 'Approved')">
                                    <h5 class="grey-text text-darken-4">Porudžbenica nije plaćena</h5>
                                       <button href="javascript:void()" onclick="event.preventDefault();document.getElementById('direct-form').submit();" class="btn pay-now uppercase">Plati sad</button>
                                    <form id="direct-form" action="<?php echo e(route('unpaid')); ?>" method="POST" style="display: none;">
                                           <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="invoice" :value="invoice">
                                        <input type="hidden" name="basketToken" :value="basketToken">
                                        <input type="hidden" name="unpaid" value="true">
                                    </form>
                                    </div>

                          </div>
                     </div>
                  </div>
                  <!--<div id="CreateAlbum" class="tab-content col s12 p-lr-24 user">
                <p><span class="card-title grey-text text-darken-4">Promenite vašu lozinku
                        <i class="material-icons right close-icon">close</i></span>
                </p>
                <a href="http://kreativnihobi.bgsvetionik.com/password/reset">Promeni</a>
                     <form class="col s12" id="changePassword" name="changePassword"  method="POST" action="<?php echo e(route('password.request')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="input-field col s12 m6">
                           <input placeholder="Unesi novu lozinku:" id="password" name="password" type="password" class="validate">
                        </div>
                        <div class="input-field col s12 m6">
                           <input placeholder="Potvrdi novu lozinku:" id="confirmPassword" name="password_confirmation" type="password" class="validate" />
                        </div>
                        <div class="input-field col s12 center-align">
                           <button class="btn waves-effect waves-light user-button" type="submit" id="changePassword" >
                           Potvrdi <i class="material-icons right">send</i>
                           </button>
                        </div>
                     </form>
                  </div>-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>
            <script type="text/javascript">
               window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(),'user' => auth()->user()]); ?>;
            </script>


<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script-last' ); ?>
            <script type="text/javascript">
               $(document).ready(function(){
                    setTimeout(function() {
                      $('#alert_box').removeClass('scale-out');
                      $('#alert_box').addClass('scale-in');
                      }, 1000 );
                      setTimeout(function() {
                      $('#alert_box').removeClass('scale-in');
                      $('#alert_box').addClass('scale-out').parent().addClass('scale-out');
                      }, 5000 );
              app.refreshToken();
                });
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtvJCg4PK5KL6lJSowsR9n4do9M6LxDSU&callback=app.userMap" async defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>