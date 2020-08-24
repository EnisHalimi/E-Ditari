@extends('admin.layouts.app')
@section('title','Ndrysho Rolin')
@section('role','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
       <form  id="edit"  method="POST" action="{{ route('admin.role.update',$role->id) }}" >
            @csrf
            @method('PUT')
            <div
    class="d-sm-flex align-items-center justify-content-between mb-4"
  >
    <a href="{{route('admin.role.index')}}" class="btn btn-secondary"
      ><i class="fas fa-arrow-left"></i> Kthehu</a
    >
  </div>

  <div class="row">
      <div
        style="width: 20rem;"
        class="card ml-auto mr-auto p-4 border-left-danger"
      >
    <h3>Ndrysho rolin {{$role->name}}</h3>
        <label for="">Emri i rolit</label>
        <input id="name" name="Emri" value="{{$role->name}}" required autofocus type="text" class="form-control form-control-user @error('Emri') is-invalid @enderror" placeholder="Psh. Mesimdhenes"><br />
        @if ($errors->has('Emri'))
                          <span class="help-block">
                              <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
                          </span>
                      @endif
        <label class="mb-0">Notat</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-grade')) checked @endif  type="checkbox" name="permission[]" value="view-grade" id="view-grade"> Ndrysho
            <input @if($role->hasPermissionTo('create-grade')) checked @endif  type="checkbox" name="permission[]" value="create-grade" id="create-grade"> Shto
            <input @if($role->hasPermissionTo('edit-grade')) checked @endif  type="checkbox" name="permission[]" value="edit-grade" id="edit-grade"> Fshij
            <input @if($role->hasPermissionTo('delete-grade')) checked @endif  type="checkbox" name="permission[]" value="delete-grade" id="delete-grade">
            <hr />
          </div>
        </div>

        <label class="mb-0">Mungesat</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-notice')) checked @endif  type="checkbox" name="permission[]" value="view-notice" id="view-notice"> Ndrysho
            <input @if($role->hasPermissionTo('create-notice')) checked @endif  type="checkbox" name="permission[]" value="create-notice" id="create-notice"> Shto
            <input @if($role->hasPermissionTo('edit-notice')) checked @endif  type="checkbox" name="permission[]" value="edit-notice" id="edit-notice"> Fshij
            <input @if($role->hasPermissionTo('delete-notice')) checked @endif  type="checkbox" name="permission[]" value="delete-notice" id="delete-notice">
            <hr />
          </div>
        </div>
        <label class="mb-0">Nxenesit</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-user')) checked @endif   type="checkbox" name="permission[]" value="view-user" id="view-user"> Ndrysho
            <input @if($role->hasPermissionTo('create-user')) checked @endif   type="checkbox" name="permission[]" value="create-user" id="create-user"> Shto
            <input @if($role->hasPermissionTo('edit-user')) checked @endif  type="checkbox" name="permission[]" value="edit-user" id="edit-user"> Fshij
            <input @if($role->hasPermissionTo('delete-user')) checked @endif  type="checkbox" name="permission[]" value="delete-user" id="delete-user">
            <hr />
          </div>
        </div>
        <label class="mb-0">Stafi</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-admin')) checked @endif  type="checkbox" name="permission[]" value="view-admin" id="view-admin"> Ndrysho
            <input @if($role->hasPermissionTo('create-admin')) checked @endif  type="checkbox" name="permission[]" value="create-admin" id="create-admin"> Shto
            <input @if($role->hasPermissionTo('edit-admin')) checked @endif  type="checkbox" name="permission[]" value="edit-admin" id="edit-admin"> Fshij
            <input @if($role->hasPermissionTo('delete-admin')) checked @endif  type="checkbox" name="permission[]" value="delete-admin" id="delete-admin">
            <hr />
          </div>
        </div>
        <label class="mb-0">Klasa</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-classroom')) checked @endif  type="checkbox" name="permission[]" value="view-classroom" id="view-classroom"> Ndrysho
            <input @if($role->hasPermissionTo('create-classroom')) checked @endif  type="checkbox" name="permission[]" value="create-classroom" id="create-classroom"> Shto
            <input @if($role->hasPermissionTo('edit-classroom')) checked @endif  type="checkbox" name="permission[]" value="edit-classroom" id="edit-classroom"> Fshij
            <input @if($role->hasPermissionTo('delete-classroom')) checked @endif  type="checkbox" name="permission[]" value="delete-classroom" id="delete-classroom">
            <hr />
          </div>
        </div>
        <label class="mb-0">Lendet</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-subject')) checked @endif  type="checkbox" name="permission[]" value="view-subject" id="view-subject"> Ndrysho
            <input @if($role->hasPermissionTo('create-subject')) checked @endif  type="checkbox" name="permission[]" value="create-subject" id="create-subject"> Shto
            <input @if($role->hasPermissionTo('edit-subject')) checked @endif  type="checkbox" name="permission[]" value="edit-subject" id="edit-subject"> Fshij
            <input @if($role->hasPermissionTo('delete-subject')) checked @endif  type="checkbox" name="permission[]" value="delete-subject" id="delete-subject">
            <hr />
          </div>
        </div>
        <label class="mb-0">Orari</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-schedule')) checked @endif  type="checkbox" name="permission[]" value="view-schedule" id="view-schedule"> Ndrysho
            <input @if($role->hasPermissionTo('create-schedule')) checked @endif  type="checkbox" name="permission[]" value="create-schedule" id="create-schedule"> Shto
            <input @if($role->hasPermissionTo('edit-schedule')) checked @endif  type="checkbox" name="permission[]" value="edit-schedule" id="edit-schedule"> Fshij
            <input @if($role->hasPermissionTo('delete-schedule')) checked @endif  type="checkbox" name="permission[]" value="delete-schedule" id="delete-schedule">
            <hr />
          </div>
        </div>
        <label class="mb-0">Shkolla</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-school')) checked @endif  type="checkbox" name="permission[]" value="view-school" id="view-school"> Ndrysho
            <input @if($role->hasPermissionTo('create-school')) checked @endif  type="checkbox" name="permission[]" value="create-school" id="create-school"> Shto
            <input @if($role->hasPermissionTo('edit-school')) checked @endif  type="checkbox" name="permission[]" value="edit-school" id="edit-school"> Fshij
            <input @if($role->hasPermissionTo('delete-school')) checked @endif  type="checkbox" name="permission[]" value="delete-school" id="delete-school">
            <hr />
          </div>
        </div>
        <label class="mb-0">Rolet</label>
        <div class="row">
          <div class="col-12">
            Shiko <input @if($role->hasPermissionTo('view-role')) checked @endif  type="checkbox" name="permission[]" value="view-role" id="view-role"> Ndrysho
            <input @if($role->hasPermissionTo('create-role')) checked @endif  type="checkbox" name="permission[]" value="create-role" id="create-role"> Shto
            <input @if($role->hasPermissionTo('edit-role')) checked @endif  type="checkbox" name="permission[]" value="edit-role" id="edit-role"> Fshij
            <input @if($role->hasPermissionTo('delete-role')) checked @endif  type="checkbox" name="permission[]" value="delete-role" id="delete-role">
            <hr />
          </div>
        </div>
    </form>
    <form class="d-inline" id="delete" method="POST" action="{{ route('admin.role.destroy',$role->id)}}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
    </form>
        <div class="row justify-content-around">
          <button form="edit" class="btn btn-info mt-3" type="submit">
            Ndrysho
          </button>
          <button type="submit" form="delete" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Fshij</button>
        </div>
      </div>

    </div>

</div>
@endsection
