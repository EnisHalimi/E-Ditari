@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Emri</th>
                    <th scope="col">Viti</th>
                    <th scope="col">Nr i profesoreve</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <th>{{ $subject->name}} </th>
                <td>{{ $subject->year}}</td>
                <td>{{ $subject->admins->count()}}</td>
              </tr>
            </tbody>
          </table>
    </div>
    <div class="row">
        <h4>Profesorat</h4>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">Emri Mbiemri</th>
                  <th scope="col">Ditelindja</th>
                  <th scope="col">Adresa</th>
                  <th scope="col">Qyteti</th>
                  <th scope="col">Banimi</th>
                  <th scope="col">Nr Tel</th>
                  <th scope="col">Grada</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subject->admins as $admin)
                <tr>
                  <th>{{ $admin->first_name}} {{$admin->fathers_name}} {{$admin->surname}}</th>
                  <td>{{ $admin->birthday}}</td>
                  <td>{{ $admin->address}}</td>
                  <td>{{ $admin->city}}</td>
                  <td>{{ $admin->residence}}</td>
                  <td>{{ $admin->phone_nr}}</td>
                  <td>{{ $admin->grade}} </td>
                </tr>
                @endforeach
              </tbody>
          </table>

    </div>
</div>
@endsection
