<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!--  SHOW  -->
    <div class="products">
             <div class="row">
                  <div class="col s12 m3 l3 filter-container">
                          <ul class="collapsible" data-collapsible="expandable">
                              <li>
                                  <div class="collapsible-header active tooltipped" data-position="bottom" data-delay="10" data-background="purple lighten-3" data-tooltip="Odaberi te Kategoriju za ažuriranje!">

                                                <i class="material-icons purple-text text-darken-3">folder</i><span>Kategorije</span>

                                  </div>
                                  <div class="collapsible-body">
                                      <ul>
                                              <li v-for="(category,index) in categories" :index="index" class="purple-text text-darken-3">
                                                    <input name="categoryId" type="radio" @change="getCategory(category)" :id="'Dirt Devil'+index" :value="category.id">
                                                          <label :for="'Dirt Devil'+index">{{category.short_title }}</label>
                                                    <div class="switch">
                                                          <p>Status</p>
                                                          <label> OFF <input type="checkbox"  @click="update( category,$event, 'Kategorija')" :checked="category.status"> <span class="lever"></span>  ON </label>
                                                    </div>
                                              </li>
                                      </ul >
                                  </div>
                              </li>
                          </ul>
                </div>
               <div class="col s12 m3 l3 filter-container">

                          <ul class="collapsible" data-collapsible="expandable" v-if="selectedSubCat.length">
                              <li>
                                  <div class="collapsible-header active tooltipped" data-position="bottom" data-delay="10" data-background="purple lighten-3" data-tooltip="Odaberi te Pod Kategoriju za ažuriranje!">

                                                <i class="material-icons purple-text text-darken-3">folder</i><span>Pod Kategorije</span>

                                  </div>
                                  <div class="collapsible-body" >
                                                <ul>
                                                        <li  v-for="(item,index) in selectedSubCat" :index="index">
                                                              <input type="radio" name="subcategoryId" @change="getSubCategory(item)" :id="'Devil' + index" :value="item.id">
                                                              <label :for="'Devil' + index">{{ item.short_name }}</label>
                                                              <div class="switch">
                                                                    <p>Status</p>
                                                                    <label> OFF <input type="checkbox"  @click="update(item,$event, 'Pod-Kategorija')" :checked="item.status ? 'checked': false"> <span class="lever"></span>  ON </label>
                                                              </div>
                                                        </li>
                                                </ul>
                                  </div>
                              </li>
                          </ul>
                  </div>
                  <div class="col s12 m6 l6 center-align" v-if="!show && selectedSubCat.length">
                  <!--************************** Proizvodi ******************-->
                  <h5 v-if="category_name" class="tooltipped" data-position="bottom" data-delay="10" data-background="purple lighten-3" data-tooltip="Odaberi te Proizvod za ažuriranje!">{{ category_name }}</h5>
                  <div class="col s12 m4 l4 cards-product"  v-for="(item,index) in selectedSubCat" :index="index" >
                      <div class="card hoverable banner">
                        <div class="update-btns">

                            <a class="btn-floating waves-effect waves-light purple darken-3 tooltipped" data-background-color="purple lighten-3" data-position="left" data-delay="10" data-tooltip="Izmeni proizvod!" @click="readyToEdit(item,$event)"><i class="material-icons">mode_edit</i></a>
                            <a class="btn-floating waves-effect waves-light purple darken-3 modal-trigger tooltipped" data-background-color="purple lighten-3" data-position="right" data-delay="10" data-tooltip="Ukloni proizvod!"  href="#modal1" @click="getItem(item,$event)"><i class="material-icons">delete</i></a>
                        </div>
                          <div class="card-image">
                                  <img :src="'http://kreativnihobi.bgsvetionik.com/images/' + item.img" alt="Baner" />
                          </div>
                              <div class="card-content center-align">
                                  <p class="card-title">{{category_name ? category_name : ''}}</p>
                                  <p class="card-type">{{item.short_name}}</p>
                                  <a href="" class="waves-effect waves-light btn purple darken-3">Detaljnije</a>
                                     <!-- Switch -->
                                    <div class="switch tooltipped" data-position="bottom" data-delay="10" data-background="purple lighten-3" data-tooltip="Promeni te Status proizvoda!">
                                          <p>Status</p>
                                          <label> OFF <input type="checkbox"  @click="update(item,$event, 'Pod-Kategorija')" :checked="item.status ? 'checked': false"> <span class="lever"></span>  ON </label>
                                    </div>
                              </div>
                      </div>
                  </div>
                   <ul class="pagination purple-text text-darken-3" v-if="category_name">
                      <li class="disabled"><a href=""><i class="material-icons">chevron_left</i></a></li>
                      <li class="active purple darken-3"><a href="#!"></a></li>
                      <li class="waves-effect"><a href="">{{selectedSubCat.to}}</a></li>
                      <li class="waves-effect"><a href=""><i class="material-icons">chevron_right</i></a></li>
                    </ul>
                  </div>

              <child v-if="show"><child>

             </div>
            <div id="modal1" class="modal">
                  <div class="modal-content center-align">
                        <h5>Proizvod <br> {{toDelete.subcategory_name ? toDelete.subcategory_name : toDelete.category_name}}</h5>
                        <p>Je spreman za uklanjanje!</p>

                        <p>Da uklonite proizvod pritisni te DA<br>Da se vratite korak u nazad pritisni te NE</p>
                  </div>
                  <div class="modal-footer">
                      <a href="#!" class="modal-action modal-close btn waves-effect waves-light  deep-purple " @click="deleteItem(toDelete)">  Da</a>
                       <a href="#!" class="modal-action modal-close btn waves-effect waves-light  deep-purple"> Ne</a>
                  </div>
            </div>
  </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>
<script type="text/javascript">
window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(),'user' => auth()->user(),'category'=> $categories]); ?>;
var data = {
            categories: Laravel.category,
            categoryId: null,
            category_name: '',
            subcategory: '',
            status:'',
            selectedCat: [],
            selectedSubCat: [],
            products: [],
            toDelete: '',
            item:{},
            show:false
        };
Vue.component('child', {
  // camelCase in JavaScript
            props: {
                  item: {
                              type: Object,
                              default: function () {
                                          return {
                                              price: 'Cena Proizvoda u ',
                                              oldPrice:'Stara cena Proizvoda u ',
                                              status: 1,
                                              categoryName:  'Naslov Kategorije',
                                              subCategoryName: 'Naslov Pod-kategorije',
                                              sliderAction: 1,
                                              colors:'#fff',
                                              img:'sample-1.jpg'
                                          };
                              }
                  },
            } ,
            template: `
                              <div class="col s12 m3 l2 cards-product">
                                    <div class="card hoverable banner">
                                        <div class="card-image">
                                                <img :src="'/images/'+item.img" :alt="item.categoryName" />
                                        </div>
                                          <div class="card-content center-align">
                                              <p class="card-title">{{item.categoryName}}</p>
                                              <p class="card-type">{{item.subCategoryName}}</p>
                                              <p class="old-price">{{item.oldPrice}}din</p>
                                              <p class="price">{{item.price }}din</p>
                                              <p class="pdv">(sa PDV-om)</p>
                                              <a href="" class="waves-effect waves-light btn purple darken-3">Detaljnije</a>
                                          </div>
                                    </div>
                              </div>
                              `,
        });
    var app = new Vue({
        el: '#app',
        data: data,
        created: function() {},
        methods: {
            _formatNumber(num, places) {
                return num.toFixed(places)
                    .replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            },
            getCategory(item) {
                var vm = this;
                vm.category_name = item.short_title;
                vm.show =false;
                axios.post('http://kreativnihobi.bgsvetionik.com/admin/show', {
                    'id':item.id
                }).then(function(response) {
                    vm.selectedCat = response.data.product;

                }).then(function() {
                    vm.getSubCategory(vm.selectedCat)
                });
            },
            getSubCategory(item) {
                var vm = this;
                axios.post('http://kreativnihobi.bgsvetionik.com/admin/subcat', {
                    'id': item.id
                }).then(function(response) {
                    vm.selectedSubCat = response.data.subCategory;
                    console.log(vm.selectedSubCat)
                }).then(function() {
                    $('.collapsible').collapsible('open', 300);
                    $('.tooltipped').tooltip();
                    vm.scroll();
                });
            },
            readyToEdit(item,e){
              $('.material-tooltip').remove();
              this.show = true;
            },
            update(item, e, type) {
                              console.log(type)
                var vm = this;
                axios.post('http://kreativnihobi.bgsvetionik.com/admin/updateStatus', {
                    'id': item.id,
                    'status': e.target.checked,
                    'type': type
                }).then(function(response) {
                      var message = response.data.message;
                      var time =  response.data.updated;
                      var className =  response.data.className;
                      console.log('message', message)
                 //   vm.selectedSubCat = response.data.subCategory;
                        Materialize.toast(message +' <br>' + time, 4000,className)

                })
            },
            getItem(item, $event) {
                this.item = item;
                this.toDelete = item;
                subCategoryName = item,
                    categoryName = item
            },
            deleteItem(item) {
              Materialize.toast('Proizvod je uspešno obrisan.', 3000);
            },
            scroll() {
                var elem = $('body');
                elem.niceScroll({
                    scrollspeed: 60,
                    mousescrollstep: 80,
                    bouncescroll: true,
                    cursorcolor: "#22303e",
                    cursorborder: "1px solid #22303e",
                });
            }
        },
        mounted() {
            $('.dropdown-button')
                .dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    hover: true,
                    belowOrigin: true,
                    alignment: 'left'
                });
            $('.modal').modal({
                dismissible: false,
                opacity: .5,
                inDuration: 300,
                outDuration: 200,
                startingTop: '4%',
                endingTop: '10%',
   /*          ready: function(modal, trigger) {
                    console.log(modal, trigger);
                },
                complete: function(trigger) {
                    console.log( trigger);
                }
*/
            });

        /*   var elementPosition = $('.filter-container').offset();

              $(window).scroll(function(){
                      if($(window).scrollTop() > elementPosition.top){
                            $('.filter-container').css('position','fixed').css('top','100');
                      } else {
                          $('.filter-containern').css('position','relative');
                      }
                });*/
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>