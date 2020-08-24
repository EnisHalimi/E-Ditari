@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">Nxenesi</th>
                  <th scope="col">Lenda</th>
                  <th scope="col">Klasa</th>
                  <th scope="col">Profesori</th>
                  <th scope="col">Nota</th>
                  <th scope="col">Periudha</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>{{ $grade->user->full_name}} </th>
                  <td>{{ $grade->subject->name}}</td>
                  <td>{{ $grade->classroom->class_name}}</td>
                  <td>{{ $grade->admin->full_name}}</td>
                  <td>{{ $grade->grade}}</td>
                  <td>{{ $grade->period}}</td>
                </tr>
              </tbody>
          </table>
    </div>
</div>
@endsection
