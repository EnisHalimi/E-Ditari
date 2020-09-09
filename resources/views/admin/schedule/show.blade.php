@extends('admin.layouts.app')
@section('title','Shiko Orarin')
@section('schedule','active')
@section('content')
<div class="container-fullwidth">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Orari Mesimore kl. {{$classroom->class_name}}
        </h6>

      <div class="card-body">
        <a class="btn btn-success mb-2" href="{{route('admin.schedule.create',['classroom_id' => $classroom->id])}}"> Shto Orarin</a>
        <button class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModal"> Dite Pushimi
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Dite pushimi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="day-off" method="POST" action="{{ route('admin.day-off') }}" >
                    @csrf

                    <label class="mb-0" for="date">Data</label><br/>
                    <input type="date" class="@error('date') is-invalid @enderror" id="date" name="date" placeholder="Data"  required autofocus>
                    @if ($errors->has('date'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('date') }}</small></strong>
                        </span>
                    @endif
                    <input type="text" hidden name="classroom_id" value="{{$classroom->id}}">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbyll</button>
                  <button type="submit" form="day-off" class="btn btn-primary">Shto</button>
                </div>
              </div>
            </div>
          </div>
        <div class="container-fullwidth">
            <div class="col-12">
              <div id="calendar-schedule"></div>
            <input type="text" hidden id="classroom-id" value="{{$classroom->id}}">
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection
