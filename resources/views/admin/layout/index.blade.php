<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
      <head>
            <meta charset="utf-8"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1"/>
            <meta name="apple-mobile-web-app-capable" content="yes"/>
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}"/>
            <title>{{ config('app.name', 'Kreativni Hobi') }}</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
            <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">
                        <!-- Styles -->
                  <!--  Materialize CSS  -->
             {{ Html::style('css/app.css', array('media' =>'screen')) }}
                  <!--  Main CSS  -->
             {{ Html::style('css/admin/admin-style.css', array('media' =>'screen')) }}

            @yield('style')
      </head>
      <body>
            <div id="app">
            @include('admin.includes.nav')
            @include('admin.includes.partials.messages')
            @yield('content')
            </div>
            <!-- Scripts -->
            <script type="text/javascript">
               window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token(),'user' => auth()->user()]) !!};
                      var fetchChatURL = null;
            </script>
            {{ Html::script('js/app.js') }}
            {{ Html::script('js/nicescroll/jquery.nicescroll.min.js') }}
            {{ Html::script('js/admin/admin-script.js') }}
            @yield('script')
      </body>
</html>
