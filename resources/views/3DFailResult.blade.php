@extends('layouts.app')
@section('style')
<style type="text/css">
    .green {
    background-color: #4CAF50 !important;
}
#alert_box .card-content {
    padding: 10px 20px;
}
#alert_box button {
    background: none;
    border: none;
    position: absolute;
    top: 5px;
    right: 10px;
    font-size: 20px;
    color: #fff;
}
.min-43 {
	min-height: 43.6vh !important;
}
.border-radius-3 {
    border-radius: 3px !important;

}
.border-round {
    border-radius: 50px !important;
    width: 100px;
}
    .card .card-content .notifi i{
        line-height: 32px;
        position: relative;
        top: 4px;
    }

</style>
@endsection
@section('content')

    <div class="container">
        <div class="row">
           <div class="col s12 min-43">
               <div id="alert_box" class="card red scale-transition scale-out">
                    <div class="card-content white-text">
                      <span class="card-title white-text darken-1 notifi">
                        <i class="material-icons">warning</i>{{$formatedResponse['Response'] == 'Declined' ? 'Transakcija je Odbijena.' :  'Transakcija je Odbijena.'}}</span>
                        <p>{{$formatedResponse['ErrMsg']}}</p>
                    </div>
                    <button type="button" class="close white-text" @click="closeAlert();">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
           </div>
        </div>
    </div>

@endsection
@section( 'script' )
<script type="text/javascript">
$(document).ready(function(){
  setTimeout(function() {
    $('#alert_box').removeClass('scale-out');
    $('#alert_box').addClass('scale-in');
    }, 1000 );
});
</script>

@endsection