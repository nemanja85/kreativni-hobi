<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
      <head>
            <meta charset="utf-8"/>
            <base href="/">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1"/>
            <meta name="apple-mobile-web-app-capable" content="yes"/>
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}"/>

            <meta name="description" content="@yield('description', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.')">
            <meta name="keywords" content="@yield('keywords', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.')">

            <meta property="og:title" content="@yield('og:title', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.')">
            <meta property="og:image" content="@yield('og:image', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.')">
            <meta property="og:description" content="@yield('og:description', 'Shopware Agentur, Tutorials, Online Kurse & Hosting.')">

            <title>@yield('title', 'Kreativni Hobi')</title>
            <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
            <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
                        <!-- Styles -->
                  <!--  Materialize CSS  -->
            {{ Html::style('css/app.css', array('media' =>'screen')) }}


                  <!--  Main CSS  -->
            {{ Html::style('css/style.css', array('media' =>'screen')) }}
            {{ Html::style('css/slider.css', array('media' =>'screen')) }}
            {{ Html::style('css/colors.css', array('media' =>'screen')) }}

            @yield('style')
      </head>
      <body>
            <div id="app" @scroll="isScrolling">
            @include('includes.nav')

            @yield('content')
            @include('includes.footer')
            <div class="fixed-action-btn" id="to-top">
                <a class="btn-floating btn-large bg-gold" @click="scrollTop();">
                  <i class="material-icons">arrow_upward</i>
                </a>
            </div>
            </div>
            <!-- Scripts -->
            @yield('laravel-script')
            {{ Html::script('js/jquery.min.js') }}
            {{ Html::script('js/vue.min.js') }}
            {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.13/vue-resource.min.js') }}
            {{ Html::script('js/axios.min.js') }}
            {{ Html::script('js/materialize.min.js') }}
            <script type="text/javascript">
               window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token(),'user' => auth()->user(),'category'=> $parents,'category_name' => isset($category_name)? $category_name : '','selectedSubCat'=> isset($subCat)?$subCat:null]) !!};
            </script>
            @yield('script')
            <!--{{ Html::script('js/nicescroll/jquery.nicescroll.min.js') }}-->

            {{ Html::script('js/main.js') }}
            @yield('script-last')
      </body>
</html>
