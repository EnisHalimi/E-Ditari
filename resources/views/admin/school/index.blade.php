@extends('admin.layouts.app')
@section('title','Shkollat')
@section('school','active')
@section('content')   <!-- Page Heading -->
<div
  class="d-sm-flex align-items-center justify-content-between mb-4"
>
<a href="/admin" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kthehu</a>
  <h1 class="h3 mb-0 text-gray-800  ml-auto mr-auto">Shkollat</h1>
  <a
    href="#"
    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
    ><i class="fas fa-download fa-sm text-white-50"></i> Gjenero
    Raportin</a
  >
</div>

<div class="row">

    @if(Auth::user()->email ==  env('APP_SA'))
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                Shto shkolle
              </div>
            </div>
            <div class="col-auto">
              <a href="{{route('admin.school.create')}}"><i class="fas fa-edit fa-2x"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

</div>

<!-- Begin Page Content -->
<div class="container-fullwidth">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      Lista e shkollave te Kosoves
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
            <th>Shkolla</th>
            <th>Niveli</th>
            <th>Kodi i shkolles</th>
            <th>Vendi</th>
            <th>Komuna</th>
            <th width="100px">Shiko / fshij</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Shkolla</th>
            <th>Niveli</th>
            <th>Kodi i shkolles</th>
            <th>Vendi</th>
            <th>Komuna</th>
            <th width="100px">Shiko / fshij</th>
          </tr>
        </tfoot>
        <tbody>
            @foreach($schools as $school)
          <tr>
            <td>{{ $school->name}}</td>
            <td>{{ $school->level}}</td>
            <td> {{$school->code}}</td>
            <td>{{ $school->address}}</td>
            <td>{{$school->city}}</td>
            <td><a class="btn btn-primary btn-circle" href="{{route('admin.school.edit',$school->id)}}"><i class="far fa-eye"></i></a>
                @if(Auth::user()->email ==  env('APP_SA')) <form class="d-inline" id="delete{{$school->id}}" method="POST" action="{{ route('admin.school.destroy',$school->id)}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <button type="submit" form="delete{{$school->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                @endif
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
