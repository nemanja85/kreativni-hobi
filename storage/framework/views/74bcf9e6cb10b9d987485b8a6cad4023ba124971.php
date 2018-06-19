<?php $__env->startSection('style'); ?>
<style type="text/css">

	body{   min-height: 100%;}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--  PRODUCTS  -->
 <div class="products category">
	    <div class="container nav-wrapper">

	        <div class="col s12" v-cloak>
	          		<a href="<?php echo e(route('proizvodi')); ?>" class="breadcrumb">Proizvodi</a>
	          		<a class="breadcrumb false-cat"
	          		v-if="!selectedSubCat.category" v-cloak><?php echo e(isset($category_name) ? $category_name : $parents[0]->category_name); ?></a>

	          		<a :href="newUrl.cat" class="breadcrumb true-cat"
	          		 v-if="selectedSubCat.category" v-cloak>{{selectedSubCat.category}}</a>

	          		<a class="breadcrumb false-sub" v-if="!selectedSubCat.category && selectedProducts.subCat" v-cloak><?php echo e(isset($subcategory_name) ? $subcategory_name:''); ?></a>

	           		<a class="breadcrumb true-sub"  v-if="selectedProducts.subCat" v-cloak>{{selectedProducts.subCat}}</a>


	          		<span class="breadcrumb" v-if="newUrl.cat  && !newUrl.cat.sub"></span>
	        </div>
	    </div>
      <div class="bg-gray">
          <div class="container cards">
             <div class="row">
                  <div class="col s12 m5 l3">
                      <div class="filter-container">
	                            <ul class="collapsible" data-collapsible="expandable">
	                                <li>
	                                    <div class="collapsible-header"><i class="material-icons font-violet">folder</i>Kategorije</div>
	                                    <div class="collapsible-body">
	                                    <?php if($parents): ?>

	                                       	<ul class="cat-list">
		                                         <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                            <li  data-cat-name="<?php echo e(isset($category_name) ? $category_name :  isset($parent->slug) ? $parent->slug : ''); ?>">
		                                                <input type="checkbox" name="category_id" id="Dirt-Devil<?php echo e($parent->id); ?>" value="<?php echo e($parent->id); ?>" @click="getSubCategory(<?php echo e($parent->id); ?>,'<?php echo e($parent->slug); ?>', $event) ">
		                                                <label for="Dirt-Devil<?php echo e($parent->id); ?>" ><?php echo e($parent->short_title); ?> <?php echo e(($parent->subCategory->count() > 0) ? "(". $parent->subCategory->count() .")"  : ""); ?>   <?php echo e(($parent->products->count() > 0) ? "(". $parent->products->count() .")"  : ""); ?></label>
		                                            </li>
			                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					 </ul>
			             <?php endif; ?>
	                                    </div>
	                                </li>
	                            </ul>
	                           <!-- <ul class="collapsible" data-collapsible="expandable" v-if="selectedSubCat.length">
	                                <li class="active">
	                                    <div class="collapsible-header active"><i class="material-icons font-violet">folder_open</i>Podkategorije</div>
	                                    <div class="collapsible-body">
	                                                <ul class="sub-cat">
	                                                        <li  v-for="(item,index) in selectedSubCat" :index="index">
	                                                              <input type="checkbox" name="subcategoryId" @change="getProduct(item, $event)" :id="'Devil' + index" :value="item.id">
	                                                              <label :for="'Devil' + index">{{ item.short_name }}</label>
	                                                        </li>
	                                                </ul>
	                                    </div>
	                                </li>
	                            </ul>-->
	                        </div>
	                  </div>
	                  <div class="col s12 m7 l9 cards-product">
	                      <div class="row">
		                      <div v-if="!showProduct && selectedSubCat.length" class="gore" v-cloak>
		                              <div class="col s12 m12 l6 xl4"  v-for="(sub,index) in selectedSubCat" :index="index" :data-products-id="sub.id" >
		                              <div class="card hoverable">
		                                        <div class="card-image">
		                                          <img :src="'<?php echo e(asset('images')); ?>/'+ sub.img">
		                                        </div>
		                                        <div class="card-content allproducts">
		                                          <span class="card-title">{{ sub.short_name }}</span>
		                                          <a href="javascript:void(0);" @click="getProduct(sub, $event)" class="waves-effect waves-light btn">Detaljnije</a>
		                                        </div>
		                                    </div>
		                                </div>
		                      </div>
	                      <div v-if="showProduct && selectedSubCat.length" class="dole" v-cloak>
	                              <div class="col s12 m12 l4"  v-for="(item,index) in selectedProducts" :index="index" :data-products-id="item.id">
		                                  <div class="card hoverable">
		                                        <div class="card-image">
		                                          <img :src="'<?php echo e(asset('images')); ?>/'+ item.img">
		                                        </div>
		                                        <div class="card-content allproducts">
		                                          <span class="card-title">{{ item.name }}</span>
		                                          <p>{{item.short_description }}</p>
		                                          <a :href="'proizvodi/'+item.category_id + '/' + selectedSubCat.category + '/' +item.sub_category_id + '/' + selectedProducts.subCat + '/' + item.id + '/' + item.slug " class="waves-effect waves-light btn">Detaljnije</a>

		                                        </div>
		                                    </div>
	                                </div>
	                      </div>

	                      <div v-if="!selectedSubCat.length && itemsNosub.length" class="bez-sub" v-cloak>
		                              <div class="col s12 m12 l4"  v-for="(item,index) in itemsNosub[0].products" :index="index" :data-products-id="item.id">
			                                    <div class="card hoverable">
			                                        <div class="card-image">
			                                          <img v-if="item.img" :src="'<?php echo e(asset('images')); ?>/'+ item.img">
			                                          <img v-if="!item.img" src="<?php echo e(asset('images/akrilne-boje/Akrilne-paste/noimage.gif')); ?>">
			                                        </div>
			                                        <div class="card-content allproducts">
			                                          <span class="card-title">{{ item.name }}</span>
			                                          <p>{{item.short_description }}</p>
			                                          <a :href="'proizvodi/'+item.category_id + '/kategorija/' + item.id + '/' + item.slug " class="waves-effect waves-light btn">Detaljnije</a>

			                                        </div>
			                                    </div>
		                                </div>
	                      </div>
	                      <?php if(isset($items)): ?>
	                      <div v-if="!selectedSubCat.length && !itemsNosub.length" class="bez-subphp" v-cloak>
	                        <?php $__currentLoopData = $items[0]->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		                              <div class="col s12 m12 l4"  data-products-id="<?php echo e($item->id); ?>">
			                                    <div class="card hoverable">
			                                        <div class="card-image">
			                                        <?php if($item->img): ?>
			                                          <img src="<?php echo e(asset('images')); ?>/<?php echo e($item->img); ?>">
			                                         <?php else: ?>
			                                         <img src="<?php echo e(asset('images/akrilne-boje/Akrilne-paste/noimage.gif')); ?>">
			                                         <?php endif; ?>
			                                        </div>
			                                        <div class="card-content allproducts">
			                                          <span class="card-title"><?php echo e($item->name); ?></span>
			                                          <p><?php echo e($item->short_description); ?></p>
			                                          <a href="proizvodi/<?php echo e($item->category_id); ?>/kategorija/<?php echo e($item->id); ?>/<?php echo e($item->slug); ?>" class="waves-effect waves-light btn">Detaljnije</a>

			                                        </div>
			                                    </div>
		                                </div>
		                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                      </div>
	                      <?php endif; ?>
	              </div>
	          </div>
	      </div>
	  </div>
       </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection( 'laravel-script' ); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>