@extends('admin.layouts.app')
@section('title','Ndrysho Orar')
@section('classroom','active')
@section('content')
<div class="container">
    <form class="d-inline" id="delete" method="POST" action="{{ route('admin.schedule.destroy',$schedule->id)}}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
    </form>
    <div class="row justify-content-center">
       <form id="edit" method="POST" action="{{ route('admin.schedule.update',$schedule->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div
            style="width: 20rem;"
            class="card ml-auto mr-auto p-4 border-left-danger"
          >
            <h3>Ndrysho Orarin</h3>
            <label class="pt-2 mb-0" for="classroom">Klasa</label>
            <select class=" @error('Klasa') is-invalid @enderror" id="classroom" name="Klasa" placeholder="Klasa">
                <option value="{{$classroom->id}}">{{$classroom->class_name}}</option>
            </select>
                @if ($errors->has('Klasa'))
                    <span class="help-block">
                        <strong class="text-danger"><small>{{ $errors->first('Klasa') }}</small></strong>
                    </span>
                @endif
            <label class="pt-2 mb-0"  for="admin">Profesori</label>
            <select class=" @error('Profesori') is-invalid @enderror" id="admin" name="Profesori" placeholder="Profesori">
                @foreach($admins as $admin)
                    <option @if($schedule->admin_id == $admin->id) selected @endif  value="{{$admin->id}}">{{$admin->full_name}}</option>
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
                    <option @if($schedule->subject_id == $subject->id) selected @endif  value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Lenda'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Lenda') }}</small></strong>
                </span>
            @endif
            <label class="mb-0" for="date">Data</label>
            <input type="date" value="{{$schedule->date}}" class="@error('Data') is-invalid @enderror" id="date" name="Data" placeholder="Data"  required autofocus>
            @if ($errors->has('Data'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Data') }}</small></strong>
                </span>
            @endif
            <label class="mb-0" for="date">Ora</label>
            <select class="@error('Ora') is-invalid @enderror" id="time" name="Ora" placeholder="Ora">
                <option @if($schedule->time == "08:00:00") selected @endif  value="08:00:00">Ora e pare</option>
                <option @if($schedule->time == "09:00:00") selected @endif value="09:00:00">Ora e dyte</option>
                <option @if($schedule->time == "10:00:00") selected @endif value="10:00:00">Ora e trete</option>
                <option @if($schedule->time == "11:00:00") selected @endif value="11:00:00">Ora e katert</option>
                <option @if($schedule->time == "12:00:00") selected @endif value="12:00:00">Ora e peste</option>
                <option @if($schedule->time == "13:00:00") selected @endif value="13:00:00">Ora e gjashte</option>
            </select>
            @if ($errors->has('Ora'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Ora') }}</small></strong>
                </span>
            @endif
          </div>


                <div class="row justify-content-around">
                  <button form="edit" class="btn btn-info mt-3" type="submit">
                    Ndrysho
                  </button>
                  <button type="submit" form="delete" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Fshij</button>
                </div>
            </form>


    </div>
</div>
@endsection
