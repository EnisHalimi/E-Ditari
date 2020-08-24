@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Emri</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>{{ $role->name}} </th>
                </tr>
              </tbody>
          </table>
          <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Aksesi</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($role->permissions as $permission)
                <tr>
                  <th>{{ $permission->name}} </th>
                </tr>
                @endforeach
              </tbody>
          </table>
    </div>
</div>
@endsection
