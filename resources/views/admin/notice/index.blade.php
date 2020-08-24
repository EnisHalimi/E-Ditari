@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1> Mungesat Veretjet</h1>
    <hr>
    <a class="btn btn-success" href="/admin/notice/create"> Shto Munges/Veretjes</a>

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
                <th scope="col">Menaxhimi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($notices as $notice)
              <tr>
                <th>{{ $notice->user->full_name}} </th>
                <td>{{ $notice->schedule->subject->name}}</td>
                <td>{{ $notice->schedule->classroom->class_name}}</td>
                <td>{{ $notice->schedule->admin->full_name}}</td>
                <td>{{ $notice->description}}</td>
                <td>{{ $notice->schedule->date}}</td>
                <td>{{ $notice->schedule->time}}</td>
                <td><a class="btn btn-secondary" href="/admin/notice/{{$notice->id}}">Shiko</a>
                    <a class="btn btn-primary" href="/admin/notice/{{$notice->id}}/edit">Ndrysho</a>
                    <form class="d-inline" method="POST" action="{{ route('admin.notice.destroy',$notice->id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn  btn-danger"><i class="fa fa-trash"></i>Fshij</button>
                        </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$notices->links()}}
    </div>
</div>
@endsection
