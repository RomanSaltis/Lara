@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>

               <div class="card-body">
                 <form method="POST" action="{{route('member.store')}}">


                     <div class="form-group">
                        <label>Vardas</label>
                        <input type="text" name="member_name"  class="form-control" value="{{old('member_name')}}">
                        <small class="form-text text-muted">Name</small>
                     </div>

                     <div class="form-group">
                        <label>Pavardė</label>
                        <input type="text" name="member_surname"  class="form-control" value="{{old('member_surname')}}">
                        <small class="form-text text-muted">Surename</small>
                     </div>

                     <div class="form-group">
                        <label>Miestas kuriame gyvena</label>
                        <input type="text" name="member_live"  class="form-control" value="{{old('member_live')}}">
                        <small class="form-text text-muted">Live</small>
                     </div>

                     <div class="form-group">
                        <label>Patirtis metais</label>
                        <input type="text" name="member_experience"  class="form-control" value="{{old('member_experience')}}">
                        <small class="form-text text-muted">Experience</small>
                     </div>

                     <div class="form-group">
                        <label>Klube registruotas metais</label>
                        <input type="text" name="member_registered"  class="form-control" value="{{old('member_registered')}}">
                        <small class="form-text text-muted">Registered</small>
                     </div>

                     <div class="form-group">
                        <label>Pavadinimas</label>
                        <select name="reservoir_id" class="form-control">
                           @foreach ($reservoirs as $reservoir)
                              <option value="{{$reservoir->id}}">{{$reservoir->title}}</option>
                           @endforeach
                        </select>
                        <small class="form-text text-muted">Title</small>
                     </div>
                     
                        
                     @csrf
                     <button type="submit">ADD</button>
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection



