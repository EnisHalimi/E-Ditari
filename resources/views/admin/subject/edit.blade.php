@extends('admin.layouts.app')
@section('title','Ndrysho Lende')
@section('classroom','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.subject.update',$subject->id) }}">
            @csrf
            @method('PUT')
            <div
            style="width: 20rem;"
            class="card ml-auto mr-auto p-4 border-left-danger"
          >
       <h3>Ndrysho lenden {{$subject->name}}</h3>
            <label class="pt-2 mb-0">Emri</label>
            <input id="name" name="Emri" value="{{$subject->name}}" required autofocus type="text" class=" @error('Emri') is-invalid @enderror"  placeholder="Emri i lëndës">
            @if ($errors->has('Emri'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
                </span>
            @endif
            <label class="mb-0">Klasa</label>
            <input id="year" name="Viti" value="{{ $subject->year}}" required autofocus type="number" class=" @error('Viti') is-invalid @enderror"  placeholder="Psh 1">
                    @if ($errors->has('Viti'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Viti') }}</small></strong>
                        </span>
                    @endif
            <button class="btn btn-primary mt-3" type="submit">
              Ndrysho
            </button>
          </div>
              </form>
    </div>
</div>
@endsection
