<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
      <head>
            <meta charset="utf-8"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1"/>
            <meta name="apple-mobile-web-app-capable" content="yes"/>
            <!-- CSRF Token -->
            <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
            <title><?php echo e(config('app.name', 'Kreativni Hobi')); ?></title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
            <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
                        <!-- Styles -->
                  <!--  Materialize CSS  -->
             <?php echo e(Html::style('css/app.css', array('media' =>'screen'))); ?>

                  <!--  Main CSS  -->
             <?php echo e(Html::style('css/admin/admin-style.css', array('media' =>'screen'))); ?>


            <?php echo $__env->yieldContent('style'); ?>
      </head>
      <body>
            <div id="app">
            <?php echo $__env->make('admin.includes.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.includes.partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- Scripts -->
            <script type="text/javascript">
               window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(),'user' => auth()->user()]); ?>;
                      var fetchChatURL = null;
            </script>
            <?php echo e(Html::script('js/app.js')); ?>

            <?php echo e(Html::script('js/nicescroll/jquery.nicescroll.min.js')); ?>

            <?php echo e(Html::script('js/admin/admin-script.js')); ?>

            <?php echo $__env->yieldContent('script'); ?>
      </body>
</html>
