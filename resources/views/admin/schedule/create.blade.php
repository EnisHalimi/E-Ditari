@extends('admin.layouts.app')
@section('title','Shto Orar')
@section('classroom','active')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.schedule.store') }}" >
            @csrf
            <div
            style="width: 20rem;"
            class="card ml-auto mr-auto p-4 border-left-danger"
          >
            <h3>Shto Orarin</h3>
            <label class="pt-2 mb-0" for="classroom">Klasa</label>
            <select class=" @error('Klasa') is-invalid @enderror" id="classroom" name="Klasa" placeholder="Klasa">
                @foreach($classrooms as $classroom)
                    <option value="{{$classroom->id}}">{{$classroom->class_name}}</option>
                @endforeach
            </select>
                @if ($errors->has('Klasa'))
                    <span class="help-block">
                        <strong class="text-danger"><small>{{ $errors->first('Klasa') }}</small></strong>
                    </span>
                @endif
            <label class="pt-2 mb-0"  for="admin">Profesori</label>
            <select class=" @error('Profesori') is-invalid @enderror" id="admin" name="Profesori" placeholder="Profesori">
                @foreach($admins as $admin)
                    <option value="{{$admin->id}}">{{$admin->full_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Profesori'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Profesori') }}</small></strong>
                </span>
            @endif
            <label class="pt-2 mb-0"  for="subject">Lenda</label>
            <select class=" @error('Lenda') is-invalid @enderror" id="subject" name="Lenda" placeholder="Lenda">
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Lenda'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Lenda') }}</small></strong>
                </span>
            @endif
            <label class="mb-0" for="date">Data</label>
            <input type="date" class="@error('Data') is-invalid @enderror" id="date" name="Data" placeholder="Data"  required autofocus>
            @if ($errors->has('Data'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Data') }}</small></strong>
                </span>
            @endif
            <label class="mb-0" for="date">Ora</label>
            <select class="@error('Ora') is-invalid @enderror" id="time" name="Ora" placeholder="Ora">
                <option value="08:00:00">Ora e pare</option>
                <option value="09:00:00">Ora e dyte</option>
                <option value="10:00:00">Ora e trete</option>
                <option value="11:00:00">Ora e katert</option>
                <option value="12:00:00">Ora e peste</option>
                <option value="13:00:00">Ora e gjashte</option>
            </select>
            @if ($errors->has('Ora'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Ora') }}</small></strong>
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
