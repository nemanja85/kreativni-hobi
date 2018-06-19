<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--  NEWS  -->
    <div class="news inspiration">
      <div class="container">
          <div class="title">
                <h1>Inspiracije i Ideja</h1>
          </div>
      </div>
    	<div class="container">
   			<div class="row">

          <div class="col s12 m8 l8" v-if="!isBlog">
              <h2 class="header">Nova ideja u kreativnom hobiju</h2>
              <div class="card large">
                <div class="card-image">
                  <img src="<?php echo e(asset('images/'.$main_blog->img)); ?>" alt="<?php echo e($main_blog->title); ?>">

                </div>
                <div class="card-content">
                    <span class="card-title"><?php echo e($main_blog->title); ?></span>
                    <p> <?php echo e($main_blog->description); ?> </p>
                    <a href="javascript:fbshareCurrentPage()" class="facebook-share-button right" target="_blank"><img src="images/Facebook-share-button.png" alt="Share on Facebook" width="160px" alt="Facebook share button" /></a>
                </div>
            </div>
          </div>


          <div class="col s12 m8 l8" v-if="isBlog">
              <h2 class="header">Nova ideja u kreativnom hobiju</h2>
              <div class="card large">
                <div class="card-image">
                  <img :src="'images/'+ setBlog.img" :alt="setBlog.title">

                </div>
                <div class="card-content">
                    <span class="card-title">{{setBlog.title}}</span>
                    <p> {{setBlog.description}} </p>
                    <a href="javascript:fbshareCurrentPage()" class="facebook-share-button right" target="_blank"><img src="images/Facebook-share-button.png" alt="Share on Facebook" width="160px" alt="Facebook share button" /></a>
                </div>
            </div>
          </div>


          <div class="col s12 m4 l4">
              <h2 class="header">Novo u kreativnom hobiju</h2>


            <div class="col s12 inspiration-small">
             <?php if($blogs): ?>
                  <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card horizontal">
                      <div class="card-image">
                        <img src="<?php echo e(asset('images/'.$blog->img)); ?>" alt="<?php echo e($blog->title); ?>" />
                      </div>
                      <div class="card-stacked">
                        <div class="card-content">
                        <a href="javascript:void(0)" @click="getBlog(<?php echo e($blog->id); ?>);"><p class=""><?php echo e($blog->short_description); ?></p></a>
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