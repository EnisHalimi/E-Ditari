@extends('admin.layouts.app')
@section('title','Krijo Klase')
@section('classroom','active')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.classroom.store') }}" >
            @csrf
            <div  style="width: 20rem;" class="card ml-auto mr-auto p-4 border-left-danger">
                <h3>Shto Klasë</h3>
               <label class="mb-0">Klasa</label>
               <input id="year" name="Klasa" value="{{ old('Klasa') }}" required autofocus type="number" class=" @error('Klasa') is-invalid @enderror"  placeholder="Klasa">
               @if ($errors->has('Klasa'))
                   <span class="help-block">
                       <strong class="text-danger"><small>{{ $errors->first('Klasa') }}</small></strong>
                   </span>
               @endif
               <label class="pt-2 mb-0">Paralelja</label>
               <input id="parallel" name="Paralelja" value="{{ old('Paralelja') }}" required autofocus type="number" class=" @error('Paralelja') is-invalid @enderror"  placeholder="Paralelja">
               @if ($errors->has('Paralelja'))
                   <span class="help-block">
                       <strong class="text-danger"><small>{{ $errors->first('Paralelja') }}</small></strong>
                   </span>
               @endif
               <label class="pt-2 mb-0">Kujdestari i klasës</label>
               <select class=" @error('Kujdestari') is-invalid @enderror" id="admin" name="Kujdestari" placeholder="Kujdestari">
                @foreach($admins as $admin)
                    <option value="{{$admin->id}}">{{$admin->full_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Kujdestari'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Kujdestari') }}</small></strong>
                </span>
            @endif
               <button class="btn btn-primary mt-3" type="submit">Krijo klasën</button>
            </div>
            </form>
    </div>
</div>
@endsection
