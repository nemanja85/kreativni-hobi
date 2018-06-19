@component('mail::message')
# Introduction

<p>Poruka: {{$message['ErrMsg']}}</p>


@component('mail::table')
  		<table class="responsive-table highlight bordered">
                        <thead>
                           <tr>
                              <th colspan="2">Proizvod</th>
                              <th>Cena</th>
                              <th>Datum</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>

		@foreach($allInBaskets as $basket)
                           <tr>
                              <td colspan="2"> {{$basket->ItemInBasket[0]->name}}</td>
                              <td>{{ $basket->ItemInBasket[0]->price * $basket->amount}} Din</td>
                              <td>{{$basket->created_at}}</td>
                              <td><span class="task-cat red lighten-1">{{$basket->response == 'Declined' ? 'Odbijeno' : 'Ponisteno'}}</span></td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
@endcomponent

@component('mail::button', ['url' => 'http://kreativnihobi.bgsvetionik.com'])
Posetite Nas
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent