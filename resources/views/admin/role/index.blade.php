@extends('admin.layouts.app')
@section('title','Rolet')
@section('role','active')
@section('content') <!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Rolet dhe akseset</h1>

<div class="row">
    @foreach($roles as $role)
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{$role->name}}
            </div>
          </div>
          <div class="col-auto">
            <a href="{{route('admin.role.edit',$role->id)}}"><i class="fas fa-edit fa-2x"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Shto role
            </div>
          </div>
          <div class="col-auto">
            <a href="{{route('admin.role.create')}}"
              ><i class="fas fa-folder-plus fa-2x"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
