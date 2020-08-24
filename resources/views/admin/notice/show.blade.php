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
                  <th scope="col">Pershkrimi</th>
                  <th scope="col">Data</th>
                  <th scope="col">Ora</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>{{ $notice->user->full_name}} </th>
                  <td>{{ $notice->schedule->subject->name}}</td>
                  <td>{{ $notice->schedule->classroom->class_name}}</td>
                  <td>{{ $notice->schedule->admin->full_name}}</td>
                  <td>{{ $notice->description}}</td>
                  <td>{{ $notice->schedule->date}}</td>
                  <td>{{ $notice->schedule->time}}</td>
                </tr>
              </tbody>
          </table>
    </div>
</div>
@endsection
