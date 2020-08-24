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
                <th scope="col">Statusi</th>
                <th scope="col">Klasa</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>{{ $user->first_name}} {{$user->fathers_name}} {{$user->surname}}</th>
                <td>{{ $user->birthday}}</td>
                <td>{{ $user->address}}</td>
                <td>{{ $user->city}}</td>
                <td>{{ $user->residence}}</td>
                <td>{{ $user->phone_nr}}</td>
                <td>{{ $user->status}} </td>
                <td>{{ $user->classroom->year}}/{{ $user->classroom->parallel}}</td>
              </tr>
            </tbody>
          </table>
    </div>
</div>
@endsection
