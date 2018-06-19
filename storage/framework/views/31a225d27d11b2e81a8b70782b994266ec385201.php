<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--  NEWS  -->
        <div class="container about-item">
            <div class="title">
                <h1>Novo u kreativnom hobiju</h1>
            </div>
        </div>
    	<div class="container">
            <div class="row">
             <?php if($products): ?>
                  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col s12 m6 l6 new-prod">
                            <div class="card horizontal">
                                <div class="card-image">
                                    <img src="<?php echo e(asset('images/'.$product->img)); ?>" alt="<?php echo e($product->name); ?>" />
                                </div>
                                <div class="card-stacked new-items right-align">
                                    <div class="card-content">
                                      <p><?php echo e(str_limit($product->description, $limit = 150, $end = '...')); ?></p>
                                    </div>
                                    <div class="card-action">
                                       <a href="proizvodi/<?php echo e($product->category_id); ?>/novo/<?php echo e($product->sub_category_id); ?>/odabrani-proizvod/<?php echo e($product->id); ?>/<?php echo e($product->slug); ?>" class="waves-effect waves-light btn">Detaljnije</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endif; ?>
            </div>
   		</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>