@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>

               <div class="card-body">


              <table class="table">
                          <tr>
                              <th>Pavadinimas</th>
                              <th>Plotas kv km</th>
                              <th>Aprašymas</th>
                              <th>Edit</th>
                              <th>Delete</th>
                          </tr>
                        @foreach ($reservoirs as $reservoir)
                            <tr>
                                <td>{{$reservoir->title}}</td>
                                <td>{{$reservoir->area}}</td>
                                <td>{{$reservoir->about}}</td>
                                                                
                                <td><a class="btn btn-secondary" href="{{route('reservoir.edit',[$reservoir])}}">edit</a></td>   
                                <td>
                                <form method="POST" action="{{route('reservoir.destroy', $reservoir)}}">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">DELETE</button>
                                </form>  
                                </td>                          
                            </tr>
                        @endforeach
                      </table>


                 
                  <!-- @foreach ($reservoirs as $reservoir)
                    <a href="{{route('reservoir.edit',[$reservoir])}}">{{$reservoir->title}} {{$reservoir->area}} {{$reservoir->about}}</a>
                      <form method="POST" action="{{route('reservoir.destroy', $reservoir)}}">
                        @csrf
                        <button type="submit">DELETE</button>
                      </form>
                    <br>
                  @endforeach -->

               </div>
           </div>
       </div>
   </div>
</div>
@endsection



