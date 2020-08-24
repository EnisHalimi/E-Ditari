@extends('admin.layouts.app')
@section('title','Shiko Orarin')
@section('classroom','active')
@section('content')
<div class="container-fullwidth">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Orari Mesimore kl. {{$classroom->class_name}}
        </h6>
      <div class="card-body">
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
