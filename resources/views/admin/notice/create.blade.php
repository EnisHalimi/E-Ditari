@extends('admin.layouts.app')
@section('title','Shto Mungese')
@section('classroom','active')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.notice.store') }}" >
            @csrf
            <div
                  style="width: 20rem;"
                  class="card ml-auto mr-auto p-4 border-left-danger"
                >
                  <h3>Mungesë/Vërejtje</h3>
                  <label class="pt-2 mb-0" for="user">Nxënësi</label>
                  <select class=" @error('Nxenesi') is-invalid @enderror" id="user" name="Nxenesi" placeholder="Nxenesi">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->full_name}}</option>
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
                        <option value="{{$schedule->id}}">{{$schedule->full_name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('Orari'))
                    <span class="help-block">
                        <strong class="text-danger"><small>{{ $errors->first('Orari') }}</small></strong>
                    </span>
                @endif
                  <label class="mb-0">Përshkrimi</label>
                  <textarea class="@error('Pershkrimi') is-invalid @enderror" id="description" name="Pershkrimi" placeholder="Përshkrimi"  required autofocus rows="3"></textarea>
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
