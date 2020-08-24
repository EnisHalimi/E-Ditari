@extends('admin.layouts.app')
@section('title','Ndrysho shkolle')
@section('school','active')
@section('content') <!-- Page Heading -->
<div
  class="d-sm-flex align-items-center justify-content-between mb-4"
>
  <a href="{{route('admin.school.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kthehu</a>
</div>

<!-- Content Row -->
<div class="row">
    <form class="ml-auto mr-auto" method="POST" action="{{ route('admin.school.update',$school->id) }}" >
        @csrf
        @method('PUT')
 <div  style="width: 20rem;" class="card ml-auto mr-auto p-4 border-left-danger">
 <h3>Ndrysho Shkollën {{$school->name}}</h3>
    <label class="mb-0">Shkolla</label>
    <input id="name" name="Emri" value="{{ $school->name }}" required autofocus type="text" class=" @error('Emri') is-invalid @enderror"  placeholder="Emri i shkolles">
    @if ($errors->has('Emri'))
    <span class="help-block">
        <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
    </span>
@endif
    <label class="pt-2 mb-0">Niveli</label>
    <select id="level" name="Niveli" required autofocus type="text" class=" @error('Niveli') is-invalid @enderror" placeholder="Niveli">
        <option @if($school->level == "SHFMU") selected @endif value="SHFMU">SHFMU</option>
        <option @if($school->level == "SHMU") selected @endif value="SHMU">SHMU</option>
        <option @if($school->level == "SHM") selected @endif value="SHM">SHM</option>
    </select>
    <label class="pt-2 mb-0">Kodi i shkollës</label>
    <input type="text" id="code" name="Kodi" value="{{ $school->code }}" required class=" @error('Kodi') is-invalid @enderror" placeholder="Kodi i shkollës">
    @if ($errors->has('Kodi'))
    <span class="help-block">
        <strong class="text-danger"><small>{{ $errors->first('Kodi') }}</small></strong>
    </span>
@endif
    <label class="pt-2 mb-0">Adresa</label>
    <input type="text" id="address" name="Adresa" value="{{ $school->address }}" required class=" @error('Adresa') is-invalid @enderror" type="number" placeholder="Adresa e shkolles">
    @if ($errors->has('Adresa'))
    <span class="help-block">
        <strong class="text-danger"><small>{{ $errors->first('Adresa') }}</small></strong>
    </span>
@endif
    <label class="pt-2 mb-0">Komuna</label>
    <input type="text" id="city" name="Qyteti" value="{{$school->city }}" required class=" @error('Qyteti') is-invalid @enderror" type="number" placeholder="Komuna">
    @if ($errors->has('Qyteti'))
    <span class="help-block">
        <strong class="text-danger"><small>{{ $errors->first('Qyteti') }}</small></strong>
    </span>
@endif

    <button class="btn btn-primary mt-3" type="submit">Ndrysho shkollën</button>
 </div>
</form>

</div>

</div>
@endsection
