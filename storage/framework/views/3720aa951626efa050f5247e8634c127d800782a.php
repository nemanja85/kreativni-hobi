<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
     <!--  REGISTER  -->
    <div class="user">
      <div class="container title">
          <h1>Registruj se</h1>
          <img src="<?php echo e(asset('images/down-arrow.svg')); ?>" class="hide-on-small-only" alt="down arrow">
      </div>
      <div class="bg-gray">
          <div class="container register">
             <div class="row">
                  <form class="s12" id="register" name="register" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>

                         <!--<div class="row">
                              <div class="file-field input-field col s12 m5 l5 offset-m1 offset-l1">
                                    <div class="btn">
                                      <span>File</span>
                                      <input type="file" name="avatar">
                                    </div>
                                    <div class="file-path-wrapper">
                                      <input placeholder = "Dodaj datoteku" class="file-path validate" type="text" disabled readonly>
                                    </div>
                                </div>
                                <div class="input-field col s12 m5 l5">
                                  <input placeholder="*Korisničko ime:" id="username" name="name" type="text" class="validate">
                              </div>
                          </div>-->
                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                              <input placeholder="*Ime:" id="first_name" name="first_name" type="text" class="validate">
                              <?php if($errors->has('first_name')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('first_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                 <div class="input-field col s12 m5 l5">
                              <input placeholder="*Prezime:" id="last_name" name="last_name" type="text" class="validate">
                              <?php if($errors->has('last_name')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('last_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                          </div>
                    </div>
                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                                    <input placeholder="*E-mail:" id="email" name="email" type="email" class="validate">
                                          <?php if($errors->has('email')): ?>
                                              <span class="help-block">
                                                  <strong><?php echo e($errors->first('email')); ?></strong>
                                              </span>
                                          <?php endif; ?>
                          </div>
                          <div class="input-field col s12 m5 l5">
                                  <input placeholder="*Adresa:" id="address" name="address" type="text" class="validate" >
                                          <?php if($errors->has('address')): ?>
                                              <span class="help-block">
                                                  <strong><?php echo e($errors->first('address')); ?></strong>
                                              </span>
                                          <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                                  <input placeholder="*Grad:" id="place" name="city" type="text" class="validate">
                                          <?php if($errors->has('city')): ?>
                                              <span class="help-block">
                                                  <strong><?php echo e($errors->first('city')); ?></strong>
                                              </span>
                                          <?php endif; ?>
                          </div>

                          <div class="input-field col s12 m5 l5">
                                  <input placeholder="Telefon:" id="phone" name="phone" type="text" class="validate">
                          </div>
                    </div>
                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                                  <input placeholder="*Poštanski broj:" id="zip_code" name="zip" type="text" class="validate">
                                      <?php if($errors->has('zip')): ?>
                                          <span class="help-block">
                                              <strong><?php echo e($errors->first('zip')); ?></strong>
                                          </span>
                                      <?php endif; ?>
                          </div>

                          <div class="input-field col s12 m5 l5">
                                  <input placeholder="*Zemlja:" id="country" name="country" type="text" class="validate">
                                      <?php if($errors->has('country')): ?>
                                          <span class="help-block">
                                              <strong><?php echo e($errors->first('country')); ?></strong>
                                          </span>
                                      <?php endif; ?>
                          </div>
                    </div>
                    <div class="row">
                          <div class="input-field col s12 m5 l5 offset-m1 offset-l1">
                                <input placeholder="*Lozinka:" id="password" name="password" type="password" class="validate">
                                      <?php if($errors->has('password')): ?>
                                          <span class="help-block">
                                              <strong><?php echo e($errors->first('password')); ?></strong>
                                          </span>
                                      <?php endif; ?>
                          </div>

                        <div class="input-field col s12 m5 l5">
                            <input placeholder="*Ponovi lozinku:" id="confirmPassword" name="password_confirmation" type="password" class="validate" />
                        </div>
                    </div>
                    <div class="col s12 m10 l10 offset-l1 center-align">
                            <button class="btn waves-effect waves-light user-button" type="submit" id="register" >
                                    Registruj se
                                <i class="material-icons right">send</i>
                            </button>
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