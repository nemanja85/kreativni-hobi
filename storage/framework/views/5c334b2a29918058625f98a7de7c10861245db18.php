<?php $__env->startSection('content'); ?>
     <!--  SHOPPING BAG  -->
    <div class="shoping-bag">
      <div class="container">
          <div class="title">
              <h1>Korpa</h1>
          </div>
           <div class="row">
                <div class="col s12 ">
                    <table class="highlight responsive-table">
                        <thead>
                          <tr>
                              <th>Proizvodi</th>
                              <th>Boja</th>
                              <th>Cena</th>
                              <th>Količina</th>
                              <th>Ukupno</th>
                              <th class="center-align">Ukloni</th>
                          </tr>
                        </thead>
                        <tbody class="vue">

                          <tr v-for="(item,index) in items" :index='index' v-cloak>

                            <td>
                                <img :src="'images/'+item.item_in_basket[0].img" alt="" />
                                <span class="name" v-cloak>{{item.item_in_basket[0].name}}</span>
                            </td>
                            <td v-cloak v-if='item.item_in_basket_color.length'>
                                            <p class="m-0" >{{item.item_in_basket_color[0].name}}</p>
                                            <p class="m-0" >Code: {{item.item_in_basket_color[0].code}}</p>
                                            <span class="basket-color" :class="'cc_' + [item.item_in_basket_color[0].code]"></span>
                              </td>
                            <td v-cloak v-if='!item.item_in_basket_color.length'></td>
                            <td v-cloak>{{item.price  | formatNumber}} Din</td>
                            <td>
                                <i class="material-icons" @click="decrease(item);">remove</i>
                                <span class="quantity" v-cloak>{{ item.amount}}</span>
                                <i class="material-icons" @click="increase(item);">add</i>
                            </td>
                            <td class="price" v-cloak>{{item.price *  item.amount | formatNumber}} Din</td>
                            <td class="center-align">
                                <i class="material-icons" @click="deleteItem(item.item_in_basket[0].id);">delete</i>
                            </td>
                          </tr>
                        </tbody>
                        <tfoot v-cloak>
                          <tr>
                            <td colspan="3" class="white hide-on-med-and-down"></td>
                            <td colspan="2">Ukupno:</td>
                            <td class="price" v-cloak>{{sumare | formatNumber}} Din</td>
                          </tr>
                          <tr>
                            <td colspan="3" class="white hide-on-med-and-down"></td>
                            <td colspan="2">PDV 20%</td>
                            <td class="pdv " v-cloak>{{pdv | formatNumber}} Din</td>
                          </tr>
                          <tr class="strong uppercase">
                            <td colspan="3" class="white hide-on-med-and-down"></td>
                            <td colspan="2" class="total">Ukupna Cena</td>
                            <td class="total" v-cloak>{{total | formatNumber}} Din</td>
                          </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col s12 pt-30">
                	<button class="btn" onclick=" window.history.back()">Nazad</button>
                    <button class="btn right" id="paynow" @click="payNow();">Nastavi</button>
                </div>
            </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>