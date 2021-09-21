@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>

               <div class="card-body">
                 
            <form method="POST" action="{{route('reservoir.update',$reservoir)}}">
                <div class="form-group">
                        <label>Pavadinimas</label>
                        <input type="text" name="reservoir_title" class="form-control" value="{{old('reservoir_title',$reservoir->title)}}">
                        <small class="form-text text-muted">Title</small>
                </div>
                <div class="form-group">
                        <label>Plotas kv km</label>
                        <input type="text" name="reservoir_area" class="form-control" value="{{old('reservoir_area',$reservoir->area)}}">
                        <small class="form-text text-muted">Area</small>
                        
                </div>
                <div class="form-group">
                        <label>Aprašymas</label>
                        <input type="text" name="reservoir_about" class="form-control" value="{{old('reservoir_about',$reservoir->about)}}">
                        <small class="form-text text-muted">About</small>
                </div>

                  @csrf
                  <button type="submit">EDIT</button>
            </form>


               </div>
           </div>
       </div>
   </div>
</div>
@endsection
