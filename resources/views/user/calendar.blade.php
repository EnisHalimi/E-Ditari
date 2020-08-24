@extends('layouts.app')
@section('title','Calendar')
@section('calendar','active')
@section('content')
<div class="container mt-3">
    <div class="row">
      <div class="col-4">
        <div class="row">
          <h1>Njoftimet</h1>
          <p>
            Javen e ardhshme me daten 07.05.2020 E Hene do te jete pushim, per
            ndere te festes se Flamurit.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fullwidth">
    <div class="col-12">
      <div id="calendar"></div>
    </div>
  </div>
  @endsection
