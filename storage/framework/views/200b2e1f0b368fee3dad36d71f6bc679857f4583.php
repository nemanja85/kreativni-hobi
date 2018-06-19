<?php if($errors->any()): ?>
<div class="row" id="alert_box" @click="closeAlert();">
  <div class="col s12 m12">
    <div class="card red darken-1">
      <div class="row">
        <div class="col s12 m10">
          <div class="card-content white-text">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p><?php echo $error; ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      <div class="col s12 m2">
        <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true"></i>
      </div>
    </div>
   </div>
  </div>
</div>
<?php elseif(Session::get('flash_success')): ?>
    <div class="alert alert-success">
        <?php if(is_array(json_decode(Session::get('flash_success'),true))): ?>
            <?php echo implode('', Session::get('flash_success')->all(':message<br/>')); ?>

        <?php else: ?>
            <?php echo Session::get('flash_success'); ?>

        <?php endif; ?>
    </div>
<?php elseif(Session::get('flash_warning')): ?>
    <div class="alert alert-warning">
        <?php if(is_array(json_decode(Session::get('flash_warning'),true))): ?>
            <?php echo implode('', Session::get('flash_warning')->all(':message<br/>')); ?>

        <?php else: ?>
            <?php echo Session::get('flash_warning'); ?>

        <?php endif; ?>
    </div>
<?php elseif(Session::get('flash_info')): ?>
    <div class="alert alert-info">
        <?php if(is_array(json_decode(Session::get('flash_info'),true))): ?>
            <?php echo implode('', Session::get('flash_info')->all(':message<br/>')); ?>

        <?php else: ?>
            <?php echo Session::get('flash_info'); ?>

        <?php endif; ?>
    </div>
<?php elseif(Session::get('flash_danger')): ?>
    <div class="alert alert-danger">
        <?php if(is_array(json_decode(Session::get('flash_danger'),true))): ?>
            <?php echo implode('', Session::get('flash_danger')->all(':message<br/>')); ?>

        <?php else: ?>
            <?php echo Session::get('flash_danger'); ?>

        <?php endif; ?>
    </div>
<?php elseif(Session::get('flash_message')): ?>
    <div class="alert alert-info">
        <?php if(is_array(json_decode(Session::get('flash_message'),true))): ?>
            <?php echo implode('', Session::get('flash_message')->all(':message<br/>')); ?>

        <?php else: ?>
            <?php echo Session::get('flash_message'); ?>

        <?php endif; ?>
    </div>
<?php endif; ?>
