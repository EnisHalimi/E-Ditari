@extends('admin.layouts.app')
@section('title','Ndrysho Klase')
@section('classroom','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
		<form class="d-inline" id="delete" method="POST" action="{{ route('admin.classroom.destroy',$classroom->id)}}" accept-charset="UTF-8">
			{{ csrf_field() }}
			<input name="_method" type="hidden" value="DELETE">
		</form>
       <form id="edit" method="POST" action="{{ route('admin.classroom.update',$classroom->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div  style="width: 20rem;" class="card ml-auto mr-auto p-4 border-left-danger">
            <h3>Ndrysho Klasën {{$classroom->class_name}}</h3>
               <label class="mb-0">Klasa</label>
               <input id="year" name="Klasa" value="{{$classroom->year }}" required autofocus type="number" class=" @error('Klasa') is-invalid @enderror"  placeholder="Klasa">
               @if ($errors->has('Klasa'))
                   <span class="help-block">
                       <strong class="text-danger"><small>{{ $errors->first('Klasa') }}</small></strong>
                   </span>
               @endif
               <label class="pt-2 mb-0">Paralelja</label>
               <input id="parallel" name="Paralelja" value="{{ $classroom->parallel }}" required autofocus type="number" class=" @error('Paralelja') is-invalid @enderror"  placeholder="Paralelja">
               @if ($errors->has('Paralelja'))
                   <span class="help-block">
                       <strong class="text-danger"><small>{{ $errors->first('Paralelja') }}</small></strong>
                   </span>
               @endif
               <label class="pt-2 mb-0">Kujdestari i klasës</label>
               <select class=" @error('Kujdestari') is-invalid @enderror" id="admin" name="Kujdestari" placeholder="Kujdestari">
                @foreach($admins as $admin)
                    <option @if($classroom->admin_id == $admin->id) selected @endif value="{{$admin->id}}">{{$admin->full_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Kujdestari'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Kujdestari') }}</small></strong>
                </span>
            @endif
                 <div class="row justify-content-around">
                  <button form="edit" class="btn btn-info mt-3" type="submit">
                    Ndrysho
                  </button>
                  <button type="submit" form="delete" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Fshij</button>
                </div>
            </div>
              </form>
    </div>
</div>
@endsection
