@extends('admin.layouts.app')
@section('title','Shto Rolin')
@section('role','active')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
       <form class="form"  method="POST" action="{{ route('admin.role.store') }}" >
            @csrf
    <div
    class="d-sm-flex align-items-center justify-content-between mb-4"
  >
    <a href="{{route('admin.role.index')}}" class="btn btn-secondary"
      ><i class="fas fa-arrow-left"></i> Kthehu</a
    >
  </div>

  <div class="row">
    <form class="ml-auto mr-auto" action="">
      <div
        style="width: 20rem;"
        class="card ml-auto mr-auto p-4 border-left-danger"
      >
        <h3>Shto role dhe aksese</h3>
        <label for="">Emri i rolit</label>
        <input id="name" name="Emri" value="{{ old('Emri') }}" required autofocus type="text" class="form-control form-control-user @error('Emri') is-invalid @enderror" placeholder="Psh. Mesimdhenes"><br />
        @if ($errors->has('Emri'))
                          <span class="help-block">
                              <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
                          </span>
                      @endif
        <label class="mb-0">Notat</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-grade" id="view-grade"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-grade" id="create-grade"> Shto
            <input  type="checkbox" name="permission[]" value="edit-grade" id="edit-grade"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-grade" id="delete-grade">
            <hr />
          </div>
        </div>

        <label class="mb-0">Mungesat</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-notice" id="view-notice"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-notice" id="create-notice"> Shto
            <input  type="checkbox" name="permission[]" value="edit-notice" id="edit-notice"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-notice" id="delete-notice">
            <hr />
          </div>
        </div>
        <label class="mb-0">Nxenesit</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-user" id="view-user"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-user" id="create-user"> Shto
            <input  type="checkbox" name="permission[]" value="edit-user" id="edit-user"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-user" id="delete-user">
            <hr />
          </div>
        </div>
        <label class="mb-0">Stafi</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-admin" id="view-admin"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-admin" id="create-admin"> Shto
            <input  type="checkbox" name="permission[]" value="edit-admin" id="edit-admin"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-admin" id="delete-admin">
            <hr />
          </div>
        </div>
        <label class="mb-0">Klasa</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-classroom" id="view-classroom"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-classroom" id="create-classroom"> Shto
            <input  type="checkbox" name="permission[]" value="edit-classroom" id="edit-classroom"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-classroom" id="delete-classroom">
            <hr />
          </div>
        </div>
        <label class="mb-0">Lendet</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-subject" id="view-subject"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-subject" id="create-subject"> Shto
            <input  type="checkbox" name="permission[]" value="edit-subject" id="edit-subject"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-subject" id="delete-subject">
            <hr />
          </div>
        </div>
        <label class="mb-0">Orari</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-schedule" id="view-schedule"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-schedule" id="create-schedule"> Shto
            <input  type="checkbox" name="permission[]" value="edit-schedule" id="edit-schedule"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-schedule" id="delete-schedule">
            <hr />
          </div>
        </div>
        <label class="mb-0">Shkolla</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-school" id="view-school"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-school" id="create-school"> Shto
            <input  type="checkbox" name="permission[]" value="edit-school" id="edit-school"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-school" id="delete-school">
            <hr />
          </div>
        </div>
        <label class="mb-0">Rolet</label>
        <div class="row">
          <div class="col-12">
            Shiko <input  type="checkbox" name="permission[]" value="view-role" id="view-role"> Ndrysho
            <input  type="checkbox" name="permission[]" value="create-role" id="create-role"> Shto
            <input  type="checkbox" name="permission[]" value="edit-role" id="edit-role"> Fshij
            <input  type="checkbox" name="permission[]" value="delete-role" id="delete-role">
            <hr />
          </div>
        </div>
        <div class="row justify-content-around">
          <button class="btn btn-info mt-3" type="submit">
            Ruaj
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
  </form>
</div>
</div>
@endsection
