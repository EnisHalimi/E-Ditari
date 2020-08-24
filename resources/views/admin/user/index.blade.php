@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1> Nxenesat dhe Prinderit</h1>
    <hr>
    @can('create-user')
    <a class="btn btn-success" href="/admin/user/create"> Shto Nxenes</a>@endcan
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
                <th scope="col">Menaxhimi</th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
              <tr>
                <th>{{ $user->first_name}} {{$user->fathers_name}} {{$user->surname}}</th>
                <td>{{ $user->birthday}}</td>
                <td>{{ $user->address}}</td>
                <td>{{ $user->city}}</td>
                <td>{{ $user->residence}}</td>
                <td>{{ $user->phone_nr}}</td>
                <td>{{ $user->status}} </td>
                <td>{{ $user->classroom->year}}/{{ $user->classroom->parallel}}</td>
                <td>@can('view-user')<a class="btn btn-secondary" href="/admin/user/{{$user->id}}">Shiko</a>@endcan
                    @can('edit-user')<a class="btn btn-primary" href="/admin/user/{{$user->id}}/edit">Ndrysho</a>@endcan
                    @can('delete-user')<form class="d-inline" method="POST" action="{{ route('admin.user.destroy',$user->id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn  btn-danger"><i class="fa fa-trash"></i>Fshij</button>
                        </form>@endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$users->links()}}
    </div>
</div>
@endsection
