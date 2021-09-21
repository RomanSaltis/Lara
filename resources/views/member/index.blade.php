@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Narių sąrašas</div>
                <div class="card-header">
                 <form action="{{route('member.indexSpecifics')}}" method="get">
                   Rūšiavimas
                   <select class="form-control" name="order" id="">
                     <option value="0">rūšiuokite pagal</option>
                     <option value="name">vardas</option>
                     <option value="surname">pavardė</option>
                     <option value="registered">registracijos data</option>
                   </select>
                   Filtravimas
                   <select class="form-control" name="filter" id="">
                     <option value="0">filtruokite pagal</option>
                     @foreach($waters as $water)
                     <option value="{{$water->id}}">{{$water->title}}</option>
                     @endforeach
                   </select>
                   <button class="btn btn-primary" type="submit">rūšiuokite</button>
                 </form>
                 <a class="btn btn-secondary" href="{{route('member.index')}}">Išvalyti</a>
                
                
                </div>

               <div class="card-body">

                  <table class="table">
                          <tr>
                              <th>Vardas</th>
                              <th>Pavardė</th>
                              <th>Miestas kuriame gyvena</th>
                              <th>Patirtis metais</th>
                              <th>Klube registruotas metais</th>
                              <th>Pavadinimas</th>
                              <th>Edit</th>
                              <th>Delete</th>
                          </tr>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{$member->name}}</td>
                                <td>{{$member->surname}}</td>
                                <td>{{$member->live}}</td>
                                <td>{{$member->experience}}</td>
                                <td>{{$member->registered}}</td>
                                <td>{{$member->memberReservoir->title}}</td>
                                
                                <td><a class="btn btn-secondary" href="{{route('member.edit',[$member])}}">edit</a></td>   
                                <td>
                                <form method="POST" action="{{route('member.destroy', $member)}}">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">DELETE</button>
                                </form>  
                                </td>                          
                            </tr>
                        @endforeach
                      </table>


                    
                    <!-- @foreach ($members as $member)
                      <a href="{{route('member.edit',[$member])}}">{{$member->name}} {{$member->surename}} {{$member->memberReservoir->title}}</a>
                        <form method="POST" action="{{route('member.destroy', [$member])}}">
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




