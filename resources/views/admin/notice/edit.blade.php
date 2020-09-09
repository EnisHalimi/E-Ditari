@extends('admin.layouts.app')
@section('title','Ndrysho Mungese')
@section('classroom','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.notice.update',$notice->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div
            style="width: 20rem;"
            class="card ml-auto mr-auto p-4 border-left-danger"
          >
            <h3>Mungesë/Vërejtje</h3>
            <label class="pt-2 mb-0" for="user">Nxënësi</label>
            <select class=" @error('Nxenesi') is-invalid @enderror" id="user" name="Nxenesi" placeholder="Nxenesi">
              @foreach($users as $user)
                  <option @if($notice->user_id == $user->id) selected @endif value="{{$user->id}}">{{$user->full_name}}</option>
              @endforeach
          </select>
          @if ($errors->has('Nxenesi'))
          <span class="help-block">
              <strong class="text-danger"><small>{{ $errors->first('Nxenesi') }}</small></strong>
          </span>
      @endif
           <label class="pt-2 mb-0"  for="schedule">Orari</label>
          <select class=" @error('Orari') is-invalid @enderror" id="schedule" name="Orari" placeholder="Orari">
              @foreach($schedules as $schedule)
                  <option @if($notice->schedule_id == $schedule->id) selected @endif value="{{$schedule->id}}">{{$schedule->full_name}}</option>
              @endforeach
          </select>
          @if ($errors->has('Orari'))
              <span class="help-block">
                  <strong class="text-danger"><small>{{ $errors->first('Orari') }}</small></strong>
              </span>
          @endif
          <label class="pt-2 mb-0">Arsyeshme</label>
          <div>
              <input type="checkbox"  name="Arsyeshme" value="2" @if($notice->arsyeshme == 2) checked @endif onclick="document.getElementById('notice2').checked = false;"  class="@error('Arsyeshme') is-invalid @enderror " id="notice1">
              <label class="pt-2 mb-0" for="notice1">Arsyeshme</label>
                  @if ($errors->has('Arsyeshme'))
                      <span class="help-block">
                          <strong class="text-danger"><small>{{ $errors->first('Arsyeshme') }}</small></strong>
                      </span>
                  @endif
              </div>
          <div>
              <input type="checkbox"  name="Arsyeshme"  @if($notice->arsyeshme == 1) checked @endif onclick="document.getElementById('notice1').checked = false;" value="1" class="@error('Arsyeshme') is-invalid @enderror " id="notice2">
              <label class="pt-2 mb-0" for="notice2">Pa Arsyeshme</label>
                  @if ($errors->has('Arsyeshme'))
                      <span class="help-block">
                          <strong class="text-danger"><small>{{ $errors->first('Arsyeshme') }}</small></strong>
                      </span>
                  @endif
              </div>
            <label class="mb-0">Përshkrimi</label>
            <textarea class="@error('Pershkrimi') is-invalid @enderror" id="description" name="Pershkrimi" placeholder="Përshkrimi"  required autofocus rows="3">{{$notice->description}}</textarea>
            @if ($errors->has('Pershkrimi'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('Pershkrimi') }}</small></strong>
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
