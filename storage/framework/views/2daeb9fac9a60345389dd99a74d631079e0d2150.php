<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

   <!-- SINGLE PRODUCTS -->
    <div class="container single-product">
        <div class="row">
            <div class="col s12 m12 l12">
                <h2 class="header">Proizvodi <span class="product-category">Akrilne boje</span></h2>
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="images/products/krema.png" alt="krema" />
                    </div>
                    <div class="card-stacked">
                      <div class="card-content">
                        <span class="card-title">Chalky Chic 100ml</span>
                        <p class="card-type">Marabu</p>
                        <div class="col s12 m6 l6">
                            <p class="old-price">215,00 din</p>
                            <p class="price">215,00 din</p>
                            <p class="pdv">(sa PDV-om)</p>
                        </div>
                        <div class="col s12 m6 l6">
                            <form id="single-product" name="single-product" class="single-product" method="POST">
                                <div class="input-field col s12">
                                    <!-- Dropdown Trigger -->
                                <a class='dropdown-button btn' href='#' data-activates='dropdown1'><i class="material-icons left">expand_more</i>Izaberite boju</a>

                                <ul id='dropdown1' class='dropdown-content collection'>
                                    <li class="collection-item avatar">
                                        <a href="#!">
                                            <img src="images/yuna.jpg" alt="" class="circle">
                                            <span class="title">Crvena</span>
                                            <p>Price</p>
                                        </a>
                                    </li>
                                    <li class="collection-item avatar">
                                        <a href="#!">
                                            <img src="images/yuna.jpg" alt="" class="circle">
                                            <span class="title">Zelena</span>
                                            <p>Price</p>
                                        </a>
                                    </li>
                                    <li class="collection-item avatar">
                                        <a href="#!">
                                            <img src="images/yuna.jpg" alt="" class="circle">
                                            <span class="title">Plava</span>
                                            <p>Price</p>
                                        </a>
                                    </li>
                                </ul>
                                 <div class="picker-wrapper">
                                      <button class="btn btn-default">Select color</button>
                                      <div class="row relative">
                                          <div class="show-canvas col s6">
                                            <div class="color-picker col s6"></div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="input-field col s12">
                                    <a class="btn-flat pulse shoping-button"><i class="material-icons left">add_shopping_cart</i>Dodaj u korpu</a>
                                </div>
                                <div class="input-field col s12">
                                    <a class="btn-flat pulse order-button"><i class="material-icons left">forward</i>Poruči odmah</a>
                                </div>
                            </form>
                        </div>
                      </div>
                      <div class="card-action">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  PRODUCTS  -->
    <div class="products">
      <div class="title">
          <h1>Slični proizvodi</h1>
          <img src="images/down-arrow.svg" class="hide-on-small-only" alt="down arrow">
      </div>
      <div class="bg-gray">
          <div class="container cards">
                <div class="cards-product">
                  <div class="row">
                      <div class="col s12 m3 l3">
                          <div class="card hoverable">
                            <div class="card-image">
                               <img src="images/bg_360.jpg" alt="" />
                            </div>
                            <div class="card-content">
                                <span class="card-title">Card Title</span>
                                <p class="card-type">Card Type</p>
                                <p class="old-price">215,00 din</p>
                                <p class="price">215,00 din</p>
                                <p class="pdv">(sa PDV-om)</p>
                                <a href="javascript:void(0)" class="btn-flat card-button">Poruči</a>
                            </div>
                          </div>
                      </div>
                      <div class="col s12 m3 l3">
                          <div class="card hoverable">
                            <div class="card-image">
                               <img src="images/bg_360.jpg" alt="" />
                            </div>
                            <div class="card-content">
                                <span class="card-title">Card Title</span>
                                <p class="card-type">Card Type</p>
                                <p class="old-price">215,00 din</p>
                                <p class="price">215,00 din</p>
                                <p class="pdv">(sa PDV-om)</p>
                                <a href="javascript:void(0)" class="btn-flat card-button">Poruči</a>
                            </div>
                          </div>
                      </div>
                      <div class="col s12 m3 l3">
                          <div class="card hoverable">
                            <div class="card-image">
                               <img src="images/bg_360.jpg" alt="" />
                            </div>
                            <div class="card-content">
                                <span class="card-title">Card Title</span>
                                <p class="card-type">Card Type</p>
                                <p class="old-price">215,00 din</p>
                                <p class="price">215,00 din</p>
                                <p class="pdv">(sa PDV-om)</p>
                                <a href="javascript:void(0)" class="btn-flat card-button">Poruči</a>
                            </div>
                          </div>
                      </div>
                      <div class="col s12 m3 l3">
                          <div class="card hoverable">
                            <div class="card-image">
                               <img src="images/bg_360.jpg" alt="" />
                            </div>
                            <div class="card-content">
                                <span class="card-title">Card Title</span>
                                <p class="card-type">Card Type</p>
                                <p class="old-price">215,00 din</p>
                                <p class="price">215,00 din</p>
                                <p class="pdv">(sa PDV-om)</p>
                                <a href="javascript:void(0)" class="btn-flat card-button">Poruči</a>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>
 <script type="text/javascript">
window.addEventListener("load", function () {
    var pk = new Piklor(".color-picker", [
            "#1abc9c"
          , "#2ecc71"
          , "#3498db"
          , "#9b59b6"
          , "#34495e"
          , "#16a085"
          , "#27ae60"
          , "#2980b9"
          , "#8e44ad"
          , "#2c3e50"
          , "#f1c40f"
          , "#e67e22"
          , "#e74c3c"
          , "#ecf0f1"
          , "#95a5a6"
          , "#f39c12"
          , "#d35400"
          , "#c0392b"
          , "#bdc3c7"
          , "#7f8c8d"
        ], {
            open: ".picker-wrapper .btn"
        })
      , wrapperEl = pk.getElm(".show-canvas");

    pk.colorChosen(function (col) {
        wrapperEl.style.backgroundColor = col;
    });
});
</script>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>