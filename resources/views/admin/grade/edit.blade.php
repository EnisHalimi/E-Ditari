@extends('admin.layouts.app')
@section('title','Ndrysho Note')
@section('classroom','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.grade.update',$grade->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div
            style="width: 20rem;"
            class="card ml-auto mr-auto p-4 border-left-danger"
          >
            <h3>Ndrysho noten</h3>
            <label class="pt-2 mb-0">Nxenesi</label>
            <select class=" @error('Nxenesi') is-invalid @enderror" id="user" name="Nxenesi" placeholder="Nxenesi">
                @foreach($users as $user)
                    <option @if($grade->user_id == $user->id) selected @endif value="{{$user->id}}">{{$user->full_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Nxenesi'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Nxenesi') }}</small></strong>
                </span>
            @endif
            <label class="pt-2 mb-0">Lenda</label>
            <select class=" @error('Lenda') is-invalid @enderror" id="subject" name="Lenda" placeholder="Lenda">
                @foreach($subjects as $subject)
                    <option  @if($grade->subject_id == $subject->id) selected @endif value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Lenda'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Lenda') }}</small></strong>
                </span>
            @endif
            <label class="pt-2 mb-0">Arsimtari i lendes</label>
            <select class=" @error('Profesori') is-invalid @enderror" id="admin" name="Profesori" placeholder="Profesori">
                @foreach($admins as $admin)
                    <option @if($grade->admin_id == $admin->id) selected @endif value="{{$admin->id}}">{{$admin->full_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Profesori'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Profesori') }}</small></strong>
                </span>
            @endif
            <label class="pt-2 mb-0">Klasa</label>
            <select class=" @error('Klasa') is-invalid @enderror" id="classroom" name="Klasa" placeholder="Klasa">
                @foreach($classrooms as $classroom)
                    <option @if($grade->classroom_id == $classroom->id) selected @endif value="{{$classroom->id}}">{{$classroom->class_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('Klasa'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Klasa') }}</small></strong>
                </span>
            @endif
            <label class="pt-2 mb-0">Nota</label>
            <input id="grade" name="Nota" value="{{$grade->grade }}" required autofocus type="number" class=" @error('Nota') is-invalid @enderror"  placeholder="Nota">
            @if ($errors->has('Nota'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Nota') }}</small></strong>
                </span>
            @endif
            <label class="pt-2 mb-0">Periudha</label>
            <input id="period" name="Periudha" value="{{$grade->period }}" required autofocus type="number" class=" @error('Periudha') is-invalid @enderror"  placeholder="Periudha">
            @if ($errors->has('Periudha'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Periudha') }}</small></strong>
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
