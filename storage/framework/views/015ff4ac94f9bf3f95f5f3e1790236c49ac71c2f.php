<?php $__env->startSection('style'); ?>
<style type="text/css">
    .green {
    background-color: #4CAF50 !important;
}
.aik-response{
    padding: 50px 0;
}
#alert_box{    margin-top: 50px;}
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
.border-radius-3 {
    border-radius: 3px !important;

}
.border-round {
    border-radius: 50px !important;
    width: 100px;
}
.width-40 {
    width: 40% !important;
}
h5 {
    font-size: 1.64rem;
    line-height: 110%;
    margin: 0.82rem 0 0.656rem 0;
}
.gradient-shadow {
    box-shadow: 0 6px 20px 0 rgba(124, 77, 255, 0.5);
}
.gradient-45deg-purple-deep-purple {
    background: #7b1fa2;
    background: -webkit-linear-gradient(45deg, #420640 0%, #ec2ce6 100%);
    background: linear-gradient(45deg, #420640 0%, #ec2ce6 100%);
}
    .card .card-content .notifi i{
        line-height: 32px;
        position: relative;
        top: 4px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
           <div class="col s12 min-43">
               <div id="alert_box" class="card green scale-transition scale-out">
                    <div class="card-content white-text">
                      <span class="card-title white-text darken-1 notifi">
                        <i class="material-icons">notifications_active</i> <?php echo e($formatedResponse['Response'] == 'Approved' ? 'Transakcija je uspešno izvršena.' : ''); ?></span>


                    </div>
                    <button type="button" class="close white-text" @click="closeAlert();">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>

                         <div class="row aik-response">
                              <?php $__currentLoopData = $allInBaskets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col s12 m3 l3 xl3">
                                            <div class="card hoverable">
                                                    <div class="card-image">
                                                            <img src="<?php echo e(asset('images/'.$item->ItemInBasket[0]->img)); ?>"  alt="<?php echo e($item->ItemInBasket[0]->slug); ?>">
                                                    </div>
                                                    <div class="card-content allproducts">
                                                            <span class="card-title"><?php echo e($item->ItemInBasket[0]->name); ?></span>
                                                            <p><?php echo e($item->ItemInBasket[0]->short_description); ?></p>
                                                    </div>
                                            </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
           </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>
<script type="text/javascript">
$(document).ready(function(){
  setTimeout(function() {
    $('#alert_box').removeClass('scale-out');
    $('#alert_box').addClass('scale-in');
    }, 1000 );
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>