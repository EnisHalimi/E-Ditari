@extends('admin.layouts.app')
@section('title','Shto Lende')
@section('subject','active')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.subject.store') }}" >
            @csrf
            <div
            style="width: 20rem;"
            class="card ml-auto mr-auto p-4 border-left-danger"
          >
            <h3>Shto lendet</h3>
            <label class="pt-2 mb-0">Emri</label>
            <input id="name" name="Emri" value="{{ old('Emri') }}" required autofocus type="text" class=" @error('Emri') is-invalid @enderror"  placeholder="Emri i lëndës">
            @if ($errors->has('Emri'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
                </span>
            @endif
            <label class="mb-0">Klasa</label>
            <input id="year" name="Viti" value="{{ old('Viti') }}" required autofocus type="number" class=" @error('Viti') is-invalid @enderror"  placeholder="Psh 1">
                    @if ($errors->has('Viti'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Viti') }}</small></strong>
                        </span>
                    @endif
            <button class="btn btn-primary mt-3" type="submit">
              Ruaj
            </button>
          </div>
        </form>
    </div>
</div>
@endsection
