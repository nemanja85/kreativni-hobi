<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--  LOGIN  -->
    <div class="user">
      <div class="container title">
          <h1>Za korisnike</h1>
          <img src="images/down-arrow.svg" class="hide-on-small-only" alt="down arrow">
      </div>
      <div class="bg-gray">
          <div class="container login">
             <div class="row">
                  <form class="s12" id="login" name="login" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>

                      <div class="input-field col s12  m6 offset-m3 l4 offset-l4">
                          <input placeholder="E-mail:" id="email" name="email" type="text" class="validate" value="<?php echo e(old('email')); ?>" required autofocus/>
                          <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                      </div>
                      <div class="input-field col s12 m6 offset-m3 l4 offset-l4">
                          <input placeholder="Lozinka:" id="password" name="password" type="password" class="validate" />
                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                      </div>
                      <div class="col s6 offset-s3 m6 offset-m3 l4 offset-l4">
                            <input type="checkbox" id="test5" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>/>
                            <label for="test5" >Zapamti me</label>
                      </div>

                      <div class="input-field col s6 offset-s3 m6 offset-m3 l4 offset-l4 center-align">
                           <a href="<?php echo e(route('password.request')); ?>">Zaboravio/la si lozinku?</a>
                          </button>
                      </div>
                      <div class="input-field col s6 offset-s3 m6 offset-m3 l4 offset-l4 center-align">
                            <button class="btn waves-effect waves-light user-button" type="submit" name="login" id="login" >Prijavi se
                            <i class="material-icons right">send</i>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'script' ); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>