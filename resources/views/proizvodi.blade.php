@extends('layouts.app')
@section('style')
<style type="text/css">

	body{   min-height: 100%;}
</style>
@endsection
@section('content')
    <!--  PRODUCTS  -->
 <div class="products category">
	    <div class="container nav-wrapper">

	        <div class="col s12" v-cloak>
	          		<a href="{{route('proizvodi')}}" class="breadcrumb">Proizvodi</a>
	          		<a class="breadcrumb false-cat"
	          		v-if="!selectedSubCat.category" v-cloak>{{isset($category_name) ? $category_name : $parents[0]->category_name}}</a>

	          		<a :href="newUrl.cat" class="breadcrumb true-cat"
	          		 v-if="selectedSubCat.category" v-cloak>@{{selectedSubCat.category}}</a>

	          		<a class="breadcrumb false-sub" v-if="!selectedSubCat.category && selectedProducts.subCat" v-cloak>{{isset($subcategory_name) ? $subcategory_name:''}}</a>

	           		<a class="breadcrumb true-sub"  v-if="selectedProducts.subCat" v-cloak>@{{selectedProducts.subCat}}</a>


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
	                                    @if($parents)

	                                       	<ul class="cat-list">
		                                         @foreach ($parents as $parent)
		                                            <li  data-cat-name="{{isset($category_name) ? $category_name :  isset($parent->slug) ? $parent->slug : ''}}">
		                                                <input type="checkbox" name="category_id" id="Dirt-Devil{{$parent->id}}" value="{{$parent->id}}" @click="getSubCategory({{$parent->id}},'{{$parent->slug}}', $event) ">
		                                                <label for="Dirt-Devil{{$parent->id}}" >{{$parent->short_title}} {{($parent->subCategory->count() > 0) ? "(". $parent->subCategory->count() .")"  : ""}}   {{($parent->products->count() > 0) ? "(". $parent->products->count() .")"  : ""}}</label>
		                                            </li>
			                             @endforeach
					 </ul>
			             @endif
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
	                                                              <label :for="'Devil' + index">@{{ item.short_name }}</label>
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
		                                          <img :src="'{{asset('images')}}/'+ sub.img">
		                                        </div>
		                                        <div class="card-content allproducts">
		                                          <span class="card-title">@{{ sub.short_name }}</span>
		                                          <a href="javascript:void(0);" @click="getProduct(sub, $event)" class="waves-effect waves-light btn">Detaljnije</a>
		                                        </div>
		                                    </div>
		                                </div>
		                      </div>
	                      <div v-if="showProduct && selectedSubCat.length" class="dole" v-cloak>
	                              <div class="col s12 m12 l4"  v-for="(item,index) in selectedProducts" :index="index" :data-products-id="item.id">
		                                  <div class="card hoverable">
		                                        <div class="card-image">
		                                          <img :src="'{{asset('images')}}/'+ item.img">
		                                        </div>
		                                        <div class="card-content allproducts">
		                                          <span class="card-title">@{{ item.name }}</span>
		                                          <p>@{{item.short_description }}</p>
		                                          <a :href="'proizvodi/'+item.category_id + '/' + selectedSubCat.category + '/' +item.sub_category_id + '/' + selectedProducts.subCat + '/' + item.id + '/' + item.slug " class="waves-effect waves-light btn">Detaljnije</a>

		                                        </div>
		                                    </div>
	                                </div>
	                      </div>

	                      <div v-if="!selectedSubCat.length && itemsNosub.length" class="bez-sub" v-cloak>
		                              <div class="col s12 m12 l4"  v-for="(item,index) in itemsNosub[0].products" :index="index" :data-products-id="item.id">
			                                    <div class="card hoverable">
			                                        <div class="card-image">
			                                          <img v-if="item.img" :src="'{{asset('images')}}/'+ item.img">
			                                          <img v-if="!item.img" src="{{asset('images/akrilne-boje/Akrilne-paste/noimage.gif')}}">
			                                        </div>
			                                        <div class="card-content allproducts">
			                                          <span class="card-title">@{{ item.name }}</span>
			                                          <p>@{{item.short_description }}</p>
			                                          <a :href="'proizvodi/'+item.category_id + '/kategorija/' + item.id + '/' + item.slug " class="waves-effect waves-light btn">Detaljnije</a>

			                                        </div>
			                                    </div>
		                                </div>
	                      </div>
	                      @if(isset($items))
	                      <div v-if="!selectedSubCat.length && !itemsNosub.length" class="bez-subphp" v-cloak>
	                        @foreach ($items[0]->products as $item)

		                              <div class="col s12 m12 l4"  data-products-id="{{$item->id}}">
			                                    <div class="card hoverable">
			                                        <div class="card-image">
			                                        @if($item->img)
			                                          <img src="{{asset('images')}}/{{$item->img}}">
			                                         @else
			                                         <img src="{{asset('images/akrilne-boje/Akrilne-paste/noimage.gif')}}">
			                                         @endif
			                                        </div>
			                                        <div class="card-content allproducts">
			                                          <span class="card-title">{{ $item->name }}</span>
			                                          <p>{{$item->short_description }}</p>
			                                          <a href="proizvodi/{{$item->category_id}}/kategorija/{{$item->id}}/{{$item->slug }}" class="waves-effect waves-light btn">Detaljnije</a>

			                                        </div>
			                                    </div>
		                                </div>
		                       @endforeach
	                      </div>
	                      @endif
	              </div>
	          </div>
	      </div>
	  </div>
       </div>
</div>
@endsection
@section( 'laravel-script' )

@endsection