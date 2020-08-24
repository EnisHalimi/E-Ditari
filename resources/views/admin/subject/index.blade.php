@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1> Lendet</h1>
    <hr>
    @can('create-subject')<a class="btn btn-success" href="/admin/subject/create"> Shto Lende</a>@endcan

    <div class="row justify-content-center">

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Emri</th>
                <th scope="col">Viti</th>
                <th scope="col">Nr i profesoreve</th>
                <th scope="col">Menaxhimi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($subjects as $subject)
              <tr>
                <th>{{ $subject->name}} </th>
                <td>{{ $subject->year}}</td>
                <td>{{ $subject->admins->count()}}</td>
                <td>@can('view-subject')<a class="btn btn-secondary" href="/admin/subject/{{$subject->id}}">Shiko</a>@endcan
                    @can('edit-subject')<a class="btn btn-primary" href="/admin/subject/{{$subject->id}}/edit">Ndrysho</a>@endcan
                    @can('delete-subject')<form class="d-inline" method="POST" action="{{ route('admin.subject.destroy',$subject->id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn  btn-danger"><i class="fa fa-trash"></i>Fshij</button>
                        </form>@endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$subjects->links()}}
    </div>
</div>
@endsection
