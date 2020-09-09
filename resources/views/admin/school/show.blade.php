@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Emri</th>
                    <th scope="col">Qyteti</th>
                    <th scope="col">Adresa</th>
                    <th scope="col">Niveli</th>
                    <th scope="col">Drejtori</th>
                    <th scope="col">Menaxhimi</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <th>{{ $school->name}} </th>
                <td>{{ $school->city}}</td>
                <td>{{ $school->address}}</td>
                <td>{{ $school->level}}</td>
                <td>{{ $school->principal}}</td>
              <td>@can('edit-school')<a class="btn btn-primary" href="{{route('admin.school.edit',$school->id)}}">Ndrysho</a>@endcan</td>
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
                @foreach($school->admins as $admin)
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

    <div class="row">
        <h4>Klasat</h4>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Viti</th>
                    <th scope="col">Paralelja</th>
                    <th scope="col">Nr i nxeneseve</th>
                    <th scope="col">Kujdestari</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($school->classrooms as $class)
                  <tr>
                    <th>{{ $class->year}} </th>
                    <td>{{ $class->parallel}}</td>
                    <td>{{ $class->student_count}}</td>
                    <td>{{ $class->admin->full_name}}</td>
                  </tr>
                @endforeach
              </tbody>
          </table>

    </div>
</div>
@endsection
