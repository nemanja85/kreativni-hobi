@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <!--  ABOUT  -->
    <div class="about">
        <div class="container about-us">
           <div class="title">
                <h1>O nama</h1>
           </div>
          <div class="sub-title">
                <h2 class="center-align">Za sve one kojima je kreativnost način života</h2>
          </div>
          <p>Kao generalni distributer Nemačkih firmi MARABU i VIVA DECOR i Italijanske firme DECOMANIA, veliko nam je zadovoljstvo da Vam predstavimo široki asortiman proizvoda namenjen svim kretivcima umetnicima i hobistima. U želji da im priuštimo sve na jednom mestu naša ponuda se neprestano širi i dopunjuje novim hobi materijalima.U našoj radnji možete naći hobi boje za slikanje na različitim podlogama: staklu, keramici, tekstilu, svili, drvetu, terakoti, stiroporu, lakove za zaštitu,specijalne lakove i lepkove za salveta (salvetnu) tehniku i decoupage (dekupaž), akrilne boje, salvete, rižin papir,četkice, polimernu glinu, svilene marame i ešarpe, pasta mašine za polimernu glinu, drvene kutije, ramove, poslužavnike i dr.</p>
          <h3 class="center-align"> NEKA VAM SVAKI DAN BUDE KREATIVAN !</h3>
        </div>
        <div class="container">
              <div class="title">
                <h1>Novo u kreativnom hobiju</h1>
           </div>
        </div>
        <div class="container about-item">
            <div class="row">
                <div class="col s12 m6 l6 about-large p-0">
                    <div class="col s12 p-0">
                      <div class="card">
                        <div class="card-image">
                          <img src="images/crtanje_po_staklu.png" alt="crtanje po staklu" />
                        </div>
                        <div class="card-content">
                          <span class="card-title ">Slikajte kao profesionalac <a href="{{route('novo')}}" class="btn right">Detaljnije</a></span>
                        </div>
                        <div class="card-reveal">
                          <span class="card-title">Slikajte kao profesionalac</span>
                          <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col s12 m6 l6 about-large p-0">
                    <div class="card">
                      <div class="card-image">
                        <img src="images/easy_marble.png" alt="easy marble" />
                      </div>
                      <div class="card-content">
                        <span class="card-title ">Slikajte kao profesionalac<a href="novo" class="btn right">Detaljnije</a></i></span>
                      </div>
                      <div class="card-reveal">
                        <span class="card-title">Slikajte kao profesionalac<i class="material-icons right">close</i></span>
                        <p>Here is some more information about this product that is only revealed once clicked on.</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section( 'script' )
@endsection