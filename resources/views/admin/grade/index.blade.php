@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1> Notat</h1>
    <hr>
    <a class="btn btn-success" href="/admin/grade/create"> Shto Nota</a>

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
                <th scope="col">Menaxhimi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($grades as $grade)
              <tr>
                <th>{{ $grade->user->full_name}} </th>
                <td>{{ $grade->subject->name}}</td>
                <td>{{ $grade->classroom->class_name}}</td>
                <td>{{ $grade->admin->full_name}}</td>
                <td>{{ $grade->grade}}</td>
                <td>{{ $grade->period}}</td>
                <td><a class="btn btn-secondary" href="/admin/grade/{{$grade->id}}">Shiko</a>
                    <a class="btn btn-primary" href="/admin/grade/{{$grade->id}}/edit">Ndrysho</a>
                    <form class="d-inline" method="POST" action="{{ route('admin.grade.destroy',$grade->id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn  btn-danger"><i class="fa fa-trash"></i>Fshij</button>
                        </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$grades->links()}}
    </div>
</div>
@endsection
