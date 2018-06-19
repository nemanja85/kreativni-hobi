@extends('layouts.app')
@section('style')
@endsection
@section('content')
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
                  <img src="{{asset('images/'.$main_blog->img)}}" alt="{{$main_blog->title}}">

                </div>
                <div class="card-content">
                    <span class="card-title">{{$main_blog->title}}</span>
                    <p> {{$main_blog->description}} </p>
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
                    <span class="card-title">@{{setBlog.title}}</span>
                    <p> @{{setBlog.description}} </p>
                    <a href="javascript:fbshareCurrentPage()" class="facebook-share-button right" target="_blank"><img src="images/Facebook-share-button.png" alt="Share on Facebook" width="160px" alt="Facebook share button" /></a>
                </div>
            </div>
          </div>


          <div class="col s12 m4 l4">
              <h2 class="header">Novo u kreativnom hobiju</h2>


            <div class="col s12 inspiration-small">
             @if($blogs)
                  @foreach ($blogs as $blog)
                    <div class="card horizontal">
                      <div class="card-image">
                        <img src="{{asset('images/'.$blog->img)}}" alt="{{$blog->title}}" />
                      </div>
                      <div class="card-stacked">
                        <div class="card-content">
                        <a href="javascript:void(0)" @click="getBlog({{$blog->id}});"><p class="">{{$blog->short_description}}</p></a>
                        </div>
                      </div>
                    </div>
                  @endforeach
               @endif
            </div>
          </div>

   			</div>
   		</div>
    </div>
@endsection
@section( 'script' )
  <script language="javascript">
      function fbshareCurrentPage()
      {window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&t="+document.title, '',
      'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
      return false;

    }
     console.log(document)
  </script>
@endsection