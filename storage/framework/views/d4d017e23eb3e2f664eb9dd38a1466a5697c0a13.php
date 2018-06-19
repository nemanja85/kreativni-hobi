<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
      <head>
            <meta charset="utf-8"/>
            <base href="/">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1"/>
            <meta name="apple-mobile-web-app-capable" content="yes"/>
            <!-- CSRF Token -->
            <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>

            <meta name="description" content="<?php echo $__env->yieldContent('description', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.'); ?>">
            <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.'); ?>">

            <meta property="og:title" content="<?php echo $__env->yieldContent('og:title', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.'); ?>">
            <meta property="og:image" content="<?php echo $__env->yieldContent('og:image', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.'); ?>">
            <meta property="og:description" content="<?php echo $__env->yieldContent('og:description', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.'); ?>">

            <title><?php echo $__env->yieldContent('title', 'Kreativni Hobi'); ?></title>
            <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
            <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
                        <!-- Styles -->
                  <!--  Materialize CSS  -->
            <?php echo e(Html::style('css/app.css', array('media' =>'screen'))); ?>



                  <!--  Main CSS  -->
            <?php echo e(Html::style('css/style.css', array('media' =>'screen'))); ?>

            <?php echo e(Html::style('css/slider.css', array('media' =>'screen'))); ?>

            <?php echo e(Html::style('css/colors.css', array('media' =>'screen'))); ?>


            <?php echo $__env->yieldContent('style'); ?>
      </head>
      <body>
            <div id="app" @scroll="isScrolling">
            <?php echo $__env->make('includes.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="fixed-action-btn" id="to-top">
                <a class="btn-floating btn-large bg-gold" @click="scrollTop();">
                  <i class="material-icons">arrow_upward</i>
                </a>
            </div>
            </div>
            <!-- Scripts -->
            <?php echo $__env->yieldContent('laravel-script'); ?>
            <?php echo e(Html::script('js/jquery.min.js')); ?>

            <?php echo e(Html::script('js/vue.min.js')); ?>

            <?php echo e(Html::script('https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.13/vue-resource.min.js')); ?>

            <?php echo e(Html::script('js/axios.min.js')); ?>

            <?php echo e(Html::script('js/materialize.min.js')); ?>

            <script type="text/javascript">
               window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(),'user' => auth()->user(),'category'=> $parents,'category_name' => isset($category_name)? $category_name : '','selectedSubCat'=> isset($subCat)?$subCat:null]); ?>;
            </script>
            <?php echo $__env->yieldContent('script'); ?>
            <!--<?php echo e(Html::script('js/nicescroll/jquery.nicescroll.min.js')); ?>-->

            <?php echo e(Html::script('js/main.js')); ?>

            <?php echo $__env->yieldContent('script-last'); ?>
      </body>
</html>
