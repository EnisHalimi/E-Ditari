@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
              <tr>
                <th>{{ $admin->first_name}} {{$admin->fathers_name}} {{$admin->surname}}</th>
                <td>{{ $admin->birthday}}</td>
                <td>{{ $admin->address}}</td>
                <td>{{ $admin->city}}</td>
                <td>{{ $admin->residence}}</td>
                <td>{{ $admin->phone_nr}}</td>
                <td>{{ $admin->grade}} </td>
              </tr>
            </tbody>
          </table>
    </div>
</div>
@endsection
