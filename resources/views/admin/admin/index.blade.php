@extends('admin.layouts.app')
@section('title','Mesimdhenesit')
@section('admin','active')
@section('content')
<div
class="d-sm-flex align-items-center justify-content-between mb-4"
>
<a href="{{route('admin.home')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kthehu</a>
<h1 class="h3 mb-0 text-gray-800  ml-auto mr-auto">Mesimdhenesit</h1>
<a
  href="#"
  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
  ><i class="fas fa-download fa-sm text-white-50"></i> Gjenero
  Raportin</a
>
</div>

<div class="row">


  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Shto mesimdhenes
            </div>
          </div>
          <div class="col-auto">
          <a href="{{route('admin.admin.create')}}"><i class="fas fa-edit fa-2x"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Begin Page Content -->
<div class="container-fullwidth">

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
    Lista e mesimdhenesve
  </h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    <table
      class="table table-bordered"
      id="dataTable"
      width="100%"
      cellspacing="0"
    >
      <thead>
        <tr>
          <th>Emri dhe mbiemri</th>
          <th>Klasa</th>
          <th width="100px">Shiko / fshij</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Emri dhe mbiemri</th>
          <th>Klasa</th>
          <th width="100px">Shiko / fshij</th>
        </tr>
      </tfoot>
      <tbody>
          @foreach($admins as $admin)
        <tr>
          <td>{{$admin->full_name}} </td>
          <td>@if($admin->classroom != null){{$admin->classroom->class_name}} @else Nuk ka klase @endif  </td>
        <td><a class="btn btn-primary btn-circle" href="{{route('admin.admin.edit',$admin->id)}}"><i class="far fa-eye"></i></a>
        <form class="d-inline" id="delete{{$admin->id}}" method="POST" action="{{ route('admin.admin.destroy',$admin->id)}}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
            </form>
            <button type="submit" form="delete{{$admin->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
@endsection
