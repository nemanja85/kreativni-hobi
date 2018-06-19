<?php $__env->startComponent('mail::message'); ?>
# Introduction

<p>Poruka: <?php echo e($message['ErrMsg']); ?></p>


<?php $__env->startComponent('mail::table'); ?>
  		<table class="responsive-table highlight bordered">
                        <thead>
                           <tr>
                              <th colspan="2">Proizvod</th>
                              <th>Cena</th>
                              <th>Datum</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>

		<?php $__currentLoopData = $allInBaskets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $basket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr>
                              <td colspan="2"> <?php echo e($basket->ItemInBasket[0]->name); ?></td>
                              <td><?php echo e($basket->ItemInBasket[0]->price * $basket->amount); ?> Din</td>
                              <td><?php echo e($basket->created_at); ?></td>
                              <td><span class="task-cat red lighten-1"><?php echo e($basket->response == 'Declined' ? 'Odbijeno' : 'Ponisteno'); ?></span></td>
                           </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                     </table>
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::button', ['url' => 'http://kreativnihobi.bgsvetionik.com']); ?>
Posetite Nas
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>