<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


     <!--  GIFT CARD  -->
    <div class="gift-card">
	     <div class="container">
	        <div class="title">
	              <h1>Vaučeri</h1>
	        </div>
	        <!--<div class="gift-item">
	            <div class="row">
	                <div class="col s12 m12 l5">
	                    <img src="<?php echo e(asset ('images/poklon-vaucer.jpg')); ?>" alt="gift card" />
	                </div>
	                <div class="col s12 m12 l7 gift-description">
	                    <p>
	                        Ako Vam je ponestalo ideja ili vremena za traženje poklona, Kreativni Hobi Vam nudi odlično rešenje. Poklon vaučer je idealan i originalan poklon za rođendane, godišnjice, 8. mart, Novu Godinu i ostale prilike u kojima želite da obradujete drage osobe.
	                    </p>
	                </div>
	            </div>
	        </div>-->
	        <div class="products">
	        	<div class="cards-product">
	                <div class="row">
	<?php if(isset($vau)): ?>
                           <?php $__currentLoopData = $vau; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                    <div class="col s12 m3 l3" data-item-id="<?php echo e($gift->id); ?>">
	                        <div class="card hoverable">
	                          <div class="card-image">
	                        <img src="<?php echo e(asset('images')); ?>/<?php echo e($gift->img); ?>" alt="" />
	                          </div>
	                          <div class="card-content">
	                              <span class="card-title">Vaučer</span>
	                              <!--<p class="card-type"></p>-->
	                              <p class="price"><?php echo e($gift->price); ?> Din</p>
                              <div class="input-field">
                                  <a href="javascript:void(0)" class="btn-flat card-button"  onclick="event.preventDefault();document.getElementById('direct-form<?php echo e($gift->id); ?>').submit();">Poruči</a>
                                    <form id="direct-form<?php echo e($gift->id); ?>" action="<?php echo e(route('direct')); ?>" method="POST" style="display: none;">
                                           <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="id" value="<?php echo e($gift->id); ?>">
                                        <input type="hidden" name="basketToken" :value="basketToken">
                                        <input type="hidden" name="direct" value="1">
                                        <input type="hidden" name="amount" value="1">
                                    </form>
                              </div>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>