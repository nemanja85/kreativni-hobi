@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <!--  NEWS  -->
        <div class="container about-item">
            <div class="title">
                <h1>Novo u kreativnom hobiju</h1>
            </div>
        </div>
    	<div class="container">
            <div class="row">
             @if($products)
                  @foreach ($products as $product)
                        <div class="col s12 m6 l6 new-prod">
                            <div class="card horizontal">
                                <div class="card-image">
                                    <img src="{{asset('images/'.$product->img)}}" alt="{{$product->name }}" />
                                </div>
                                <div class="card-stacked new-items right-align">
                                    <div class="card-content">
                                      <p>{{str_limit($product->description, $limit = 150, $end = '...')}}</p>
                                    </div>
                                    <div class="card-action">
                                       <a href="proizvodi/{{$product->category_id}}/novo/{{$product->sub_category_id}}/odabrani-proizvod/{{$product->id}}/{{$product->slug}}" class="waves-effect waves-light btn">Detaljnije</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                  @endforeach
               @endif
            </div>
   		</div>
@endsection
@section( 'script' )
@endsection