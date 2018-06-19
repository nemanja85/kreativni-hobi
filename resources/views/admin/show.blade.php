@extends('admin.layout.index')
@section('style')
@endsection
@section('content')
  <!--  SHOW  -->
    <div class="products">
        <div class="cards">
             <div class="row">
                  <div class="col s12 m3 l3">
                      <div class="filter-container">
                        <input type="hidden" value="1" name="filter">
                        <input type="hidden" value="" name="term">
                        <input type="hidden" value="" name="used">
                          <ul class="collapsible" data-collapsible="expandable">
                              <li>
                                  <div class="collapsible-header active"><i class="material-icons font-violet">folder</i>Show</div>
                                  <div class="collapsible-body">
                                      <ul>
                                          <li>
                                              <input type="checkbox" name="manufacturer[]" id="Dirt Devil" value="4">
                                              <label for="Dirt Devil">Akrilne boje (3)</label>
                                          </li>
                                      </ul>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col s12 m6 l6">

                  </div>
                  <div class="col s12 m3 l3">
                      <div class="card">
                          <div class="card-image">
                            <img src="images/sample-1.jpg">
                          </div>
                          <div class="card-content">
                            <span class="card-title">Card Title</span>
                            <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                          </div>
                      </div>
                  </div>
             </div>
      </div>
  </div>

@endsection
@section( 'script' )
@endsection