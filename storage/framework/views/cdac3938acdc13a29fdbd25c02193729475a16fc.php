<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l6 p-0 hide-on-med-and-down">
                  <div class="slider" v-cloak>
                      <ul class="slides">
                          <li>
                                <img  src="<?php echo e(asset('images/baneri/dekupaz.png')); ?>"  alt="dekupaz" />
                          </li>
                          <li>
                                <img  src="<?php echo e(asset('images/baneri/staklo.png')); ?>"  alt="staklo" />
                          </li>
                          <li>
                                <img  src="<?php echo e(asset('images/baneri/porcelan_keramika.png')); ?>"  alt="porcelan keramika" />
                          </li>
                      </ul>
                  </div>
            </div>
            <div class="col s12 m12 l6 slider-effect p-0">
                        <?php if($parents): ?>
                            <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php $__currentLoopData = $categories->subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php $__currentLoopData = $subcat->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(1 == $product->action_slider): ?>
                                                   <div class="col s12 m6 l6 small p-0">
                                                        <div class="card">
                                                              <div class="card-image">
                                                                  <img class="robot_thumb" src="<?php echo e(asset('images/'.$product->img)); ?>" data-src="<?php echo e(asset('images/'.$product->img)); ?>" alt="<?php echo e($product->name); ?>">                                </div>
                                                              <div class="card-content">
                                                                  <span class="card-title truncate"><?php echo e($product->name); ?></span>
                                                                   <a href="<?php echo e(URL('proizvodi/'.$product->category_id . '/' . $categories->slug . '/' . $product->sub_category_id . '/' .  $subcat->slug . '/' . $product->id . '/' . $product->slug)); ?>" class="btn waves-effect waves-light">Detaljnije</a>
                                                              </div>
                                                        </div>
                                                    </div>
                                                  <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                <div class="col s12 p-0">
                    <div class="card">
                            <div class="card-image small">
                                <img src="images/baneri/kh_inka-tekstil.png" alt="" />
                            </div>
                            <div class="card-content">
                                <span class="card-title">Inka tekstil</span>
                                <a class="btn waves-effect waves-light right">Detaljnije</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!--  PRODUCTS  -->
    <div class="products">
      <div class="container">
          <div class="title">
              <h1>Izdvajamo</h1>
              <img src="images/down-arrow.svg" class="hide-on-small-only" alt="down arrow" />
          </div>
      </div>
      <div class="bg-gray">
          <div class="container cards">
             <div class="row">
                  <div class="col s12 m12 l3 hide-on-med-and-down">
                      <div class="card hoverable banner">
                          <div class="card-image">
                                  <img src="images/baneri/banner_akrilne-boje.png" alt="Baner" />
                          </div>
                              <div class="card-content center-align">
                                  <p class="card-title">Akrilne boje</p>
                                  <a href="/proizvodi/1/akrilne-boje" class="waves-effect waves-light btn bg-orange">Detaljnije</a>
                              </div>
                      </div>
                  </div>
                  <div class="col s12 m12 l9 cards-product">
                      <div class="row">
                    <?php if($parents): ?>
                       <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php $__currentLoopData = $categories->subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php $__currentLoopData = $subcat->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <?php if(1 == $product->chosen_product): ?>
                                                        <div class="col s12 m6 l4">
                                                            <div class="card hoverable">
                                                              <div class="card-image">
                                                             <img src="<?php echo e(asset('images/'.$product->img)); ?>" alt="<?php echo e($product->name); ?>" />
                                                              </div>
                                                              <div class="card-content">
                                                                <span class="card-title"><?php echo e($product->name); ?></span>
                                                                <p class="card-type"><?php echo e($product->name); ?></p>
                                                                <!--<p class="old-price"><?php echo e($product->old_price); ?></p>-->
                                                                <p class="price"><?php echo e($product->price); ?></p>
                                                                <a href="<?php echo e(URL('proizvodi/'.$product->category_id . '/' . $categories->slug . '/' . $product->sub_category_id . '/' .  $subcat->slug . '/' . $product->id . '/' . $product->slug)); ?>" class="waves-effect waves-light btn bg-orange">Detaljnije</a>
                                                              </div>
                                                          </div>
                                                        </div>
                                                <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!--  ABOUT  -->
    <div class="about">
        <div class="container">
            <div class="title">
                <h1>Novo u kreativnom hobiju</h1>
                <img src="images/down-arrow.svg" class="hide-on-small-only" alt="down arrow">
            </div>
        </div>
        <div class="bg-gray">
            <div class="container about-item">
                <div class="row">
                  <div class="col s12 m6 l6 about-large p-0">

                      <div class="col s12 p-0">
                        <div class="card">
                          <div class="card-image">
                            <img src="images/crtanje_po_staklu.png" alt="crtanje po staklu">
                          </div>
                          <div class="card-content">
                            <span class="card-title">Slikajte kao profesionalac<a href="<?php echo e(route('novo')); ?>" class="btn right">Detaljnije</a></span>
                          </div>
                          <div class="card-reveal">
                            <span class="card-title">Slikajte kao profesionalac</span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col s12 m6 l6 about-large p-0">
                      <div class="card">
                        <div class="card-image">
                          <img  src="images/easy_marble.png" alt="easy marble">
                        </div>
                        <div class="card-content">
                          <span class="card-title ">Slikajte kao profesionalac<a href="<?php echo e(route('novo')); ?>" class="btn right">Detaljnije</a></i></span>
                        </div>
                        <div class="card-reveal">
                          <span class="card-title">Slikajte kao profesionalac<i class="material-icons right">close</i></span>
                          <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!--  SERVICES  -->
    <div class="services bg-violet">
        <div class="container">
          <div class="row">
              <div class="col s12 m6 l4 services-item">
                  <a href="<?php echo e(route('opšti-uslovi')); ?>">
                      <img src="images/services/wallet.png" alt="Wallet" />
                  </a>
                  <span>Vrste Placanja</span>
               </div>
               <div class="col s12 m6 l4 services-item">
                  <a href="<?php echo e(route('opšti-uslovi')); ?>">
                      <img src="images/services/truck.png" alt="Truck" />
                  </a>
                  <span>Isporuka</span>
               </div>
               <div class="col s12 m6 l4 services-item">
                  <a href="<?php echo e(route('opšti-uslovi')); ?>">
                    <img src="images/services/clock.png" alt="Clock" />
                  </a>
                  <span>Želiš super brzu Dostavu</span>
              </div>
          </div>
        </div>
    </div>
    <!-- BLOG  -->
    <div class="blog">
        <div class="container">
            <div class="title">
                <h1>Saveti za kreativnost</h1>
                <img src="images/down-arrow.svg" class="hide-on-small-only" alt="down arrow">
            </div>
        </div>
        <div class="bg-gray">
            <div class="container p-50-0">
                <div class="row">
                  <div class="col s12 m12 l12">
                      <div class="row">


        <?php if($parents): ?>
                 <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="col s12 m4 l4">
                            <div class="card hoverable">
                              <div class="card-image">
                                <img src="<?php echo e(asset('images/'.$blog->img)); ?>" alt="">
                              </div>
                              <div class="card-content">
                                <span class="card-title"><?php echo e($blog->title); ?></span>
                                <p>
                                    <?php echo e($blog->short_description); ?>

                                  </p>
                              </div>
                              <div class="card-action center-align">
                                  <a href="<?php echo e(route('inspiration')); ?>" class="waves-effect waves-light btn bg-orange">Detaljnije</a>
                              </div>
                            </div>
                          </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
                      </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>


<!-- End Cookie Consent plugin -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>