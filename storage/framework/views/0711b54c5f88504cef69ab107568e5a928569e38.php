<?php $__env->startSection('title'); ?><?php echo $item->name; ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo $item->short_description; ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('keywords'); ?><?php echo $item->belongsTocategory->short_title; ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('og:title'); ?><?php echo $item->name; ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('og:image'); ?><?php echo $item->img; ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('og:description'); ?><?php echo $item->description; ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <nav class="bread">
      <div class="container nav-wrapper">
            <div class="col s12">
              <a href="<?php echo e(route('proizvodi')); ?>" class="breadcrumb">Proizvodi</a>

              <a href="<?php echo e(URL('proizvodi/'.$item->belongsTocategory->id . '/' . $item->belongsTocategory->slug)); ?>" class="breadcrumb"><?php echo e($item->belongsTocategory->short_title); ?></a>

<?php if(isset($item->belongsTosubCat->short_name)): ?>
              <a href="<?php echo e(URL('proizvodi/'.$item->belongsTocategory->id . '/' . $item->belongsTocategory->slug. '/' . $item->belongsTosubCat->id. '/' . $item->belongsTosubCat->slug)); ?>" class="breadcrumb"><?php echo e($item->belongsTosubCat->short_name ? $item->belongsTosubCat->short_name : ''); ?></a>
 <?php endif; ?>
              <span class="breadcrumb"><?php echo e($item->name); ?></span>
            </div>
        </div>
    </nav>
   <!-- SINGLE PRODUCTS -->
    <div class="container single-product" :data-item-id="<?php echo e($item->id); ?>">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="images/<?php echo e($item->img); ?>" alt="<?php echo e($item->short_description); ?>" />
                    </div>
                    <div class="card-stacked"  v-cloak>
                      <div class="card-content">
                        <span class="card-title"><?php echo e($item->name); ?></span>
                        <p class="card-type"><?php echo e($item->belongsTocategory->short_title); ?></p>
                        <div class="col s12 m12 l4 p-0"  v-cloak>
                            <p class="price" v-if="color.price">{{color.price  | formatNumber}} Din</p>
                            <p class="price"  v-if="!color.price"><?php echo e($item->price); ?> Din</p>
                            <p class="pdv">U cenu je uračunat PDV</p>
                            <p class="pdv" v-if="color.code">Code: {{color.code? color.code : ''}}</p>
                            <p class="color-p" >
                                    <span class="preview-hidden">{{color.name? color.name : ''}}</span>
                                    <span v-if="color.code"  class="preview" :class="[colorClass]"></span>
                            </p>
                            <p>
                              <a href="javascript:fbshareCurrentPage()" target="_blank"><img src="images/Facebook-share-button.png" alt="Share on Facebook" width="160px" alt="Facebook share button" /></a>
                            </p>
                        </div>
                        <div class="col s12 m12 l8 p-0 item-order">
                              <div class="input-field">
                                  <a class="btn-flat shoping-button" @click="addToBasket(<?php echo e($item->id); ?>,'<?php echo e($item->name); ?>',color.id)"><i class="material-icons left">add_shopping_cart</i>Dodaj u korpu</a>
                              </div>
                              <div class="input-field">
                                  <a href="javascript:void(0)" class="btn-flat order-button"  onclick="event.preventDefault();document.getElementById('direct-form').submit();"><i class="material-icons left">forward</i>Poruči odmah</a>
                                    <form id="direct-form" action="<?php echo e(url('placanje/basketToken')); ?>" method="POST" style="display: none;">
                                           <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                                        <input type="hidden" name="basketToken" :value="basketToken">
                                        <input type="hidden" name="direct" value="1">
                                        <input type="hidden" name="amount" value="1">
                                        <input type="hidden" name="color" v-bind:value="color.id">
                                    </form>
                              </div>
                            <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php if($parent->id == $item->category_id): ?>
                                                <?php $__currentLoopData = $parent->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                          <?php if($product->id == $item->id && $product->colors->count() > 0): ?>
                                                                    <!-- Dropdown Trigger -->
                                                                    <div class="input-field"  v-cloak>

                                                                        <div class="picker-wrapper">
                                                                            <button class="btn btn-default" @click="toggleColor();"><i class="material-icons left">color_lens </i> Izaberite</button>

                                                                            <div class="row relative" v-if="colorShow">
                                                                                <div class="show-canvas center-align">

                                                                                      <ul class="color-picker dd-options dd-click-off-close">

                                                                                            <?php $__currentLoopData = $product->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                          	                                    	<li @click="setColor(<?php echo e($color); ?>,$event);">
                                                          	                                    		<div class="dd-option waves-effect waves-dark color-topick">
                                                                                                                    <p>
                                                                                                                      <input v-model="color.id" name="Dirt-Devil" id="Devil<?php echo e($color->id); ?>" type="radio"  v-bind:value="<?php echo e($color->id); ?>">
                                                                                                                      <label class="dd-option-text" for="Devil<?php echo e($color->id); ?>"><?php echo e($color->name); ?></label>
                                                                                                                    </p>
                                                                                                                      <div class="dd-option-image right cc_<?php echo e($color->code); ?>"></div>
                                                                                                                      <p class="color"><?php echo e($color->description); ?></p>
                                                                                                                      <small class="dd-option-text" >Code: <?php echo e($color->code); ?></small>
                                                                                                                      <?php if($color->price): ?>
                                                                                                                      <small class="dd-option-text" ><?php echo e($color->price); ?> Din</small>
                                                                                                                      <?php endif; ?>

                                                                                                                </div>
                                                                                                          </li>
                                                                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                     </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                      <div class="card-action">
                        <p><?php echo e($item->description); ?></p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  PRODUCTS  -->
         <?php if($similars[0]->products->count() >0): ?>
    <div class="products">
        <div class="container">
           <div class="title">
                <h1>Slični proizvodi</h1>
                <img src="<?php echo e(asset ('images/down-arrow.svg')); ?>" class="hide-on-small-only" alt="down arrow">
            </div>
        </div>
        <div class="bg-gray">
            <div class="container cards">
                  <div class="cards-product">
                    <div class="row">

                                   <?php $__currentLoopData = $similars[0]->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col s12 m3 l3">
                                                    <div class="card hoverable">
                                                      <div class="card-image">
                                                    <img src="<?php echo e(asset('images/'.$similar->img)); ?>" alt="<?php echo e($similar->short_description); ?>" />
                                                      </div>
                                                      <div class="card-content">
                                                          <span class="card-title"><?php echo e($similar->name); ?></span>
                                                          <p class="card-type"><?php echo e($similars[0]->short_title); ?></p>
                                                          <!--<p class="old-price"><?php echo e($similar->old_price); ?> RSD</p>-->
                                                          <p class="price"><?php echo e($similar->price); ?> RSD</p>
                                                          <!--<a href="javascript:void(0)" class="btn-flat card-button">Poruči</a>-->
                                                          <?php if(isset($similar->sub_category_id)): ?>
            <a href="proizvodi/<?php echo e($similar->category_id); ?>/novo/<?php echo e($similar->sub_category_id); ?>/odabrani-proizvod/<?php echo e($similar->id); ?>/<?php echo e($similar->slug); ?>" class="btn-flat card-button">Poruči</a>
                                                           <?php else: ?>
            <a href="proizvodi/<?php echo e($similar->category_id); ?>/odabrani-proizvod/kategorija/<?php echo e($item->belongsTocategory->slug); ?>/<?php echo e($similar->id); ?>/<?php echo e($similar->slug); ?>" class="btn-flat card-button">Poruči</a>
                                                          <?php endif; ?>
                                                      </div>
                                                    </div>
                                                </div>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>

  <script language="javascript">
      function fbshareCurrentPage()
      {window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&t="+document.title, '',
      'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
      return false;

    }
     console.log(document)
  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>