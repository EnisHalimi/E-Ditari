@extends('admin.layouts.app')
@section('title','Shto Orar')
@section('classroom','active')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.schedule.store') }}" >
            @csrf
            <div

            class="card  ml-auto mr-auto p-4  border-left-danger"
          >

            <h3>Shto Orarin</h3>
            <label class="mb-0" for="start-date">Data e fillimit</label>
       <input type="text" hidden name="classroom_id" value="{{$classroom}}">
            <input type="date" class="@error('start-date') is-invalid @enderror" id="start-date" name="start-date" placeholder="Data e fillimit"  required autofocus>
            @if ($errors->has('start-date'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('start-date') }}</small></strong>
                </span>
            @endif
            <label class="mb-0" for="end-date">Data e mbarimit</label>
            <input type="date" class="@error('end-date') is-invalid @enderror" id="end-date" name="end-date" placeholder="Data e mbarimit"  required autofocus>
            @if ($errors->has('end-date'))
                <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('end-date') }}</small></strong>
                </span>
            @endif
            <table class="table my-2">
                <thead>
                    <tr>
                      <th scope="col">Ora</th>
                      <th scope="col">Hëne</th>
                      <th scope="col">Marte</th>
                      <th scope="col">Mërkure</th>
                      <th scope="col">Enjte</th>
                      <th scope="col">Premte</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td> <label class="pt-2 mb-0"  for="admin-h-1">Profesori</label><br/>
                        <select class="text-xs" id="admin-h-1" name="admin-h-1" placeholder="Profesori">
                            @foreach($admins as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                            @endforeach
                        </select><br/>
                        <label class="pt-2 mb-0"  for="subject-h-1">Lenda</label><br/>
                        <select class="text-xs" id="subject-h-1" name="subject-h-1" placeholder="Lenda">
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select></td>
                      <td> <label class="pt-2 mb-0"  for="admin-mr-1">Profesori</label><br/>
                        <select class="text-xs  " id="admin-mr-1" name="admin-mr-1" placeholder="Profesori">
                            @foreach($admins as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                            @endforeach
                        </select><br/>
                        <label class="pt-2 mb-0"  for="subject-mr-1">Lenda</label><br/>
                        <select class="text-xs" id="subject-mr-1" name="subject-mr-1" placeholder="Lenda">
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select></td>
                      <td> <label class="pt-2 mb-0"  for="admin-mk-1">Profesori</label><br/>
                        <select class="text-xs  " id="admin-mk-1" name="admin-mk-1" placeholder="Profesori">
                            @foreach($admins as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                            @endforeach
                        </select><br/>
                        <label class="pt-2 mb-0"  for="subject-mk-1">Lenda</label><br/>
                        <select class="text-xs" id="subject-mk-1" name="subject-mk-1" placeholder="Lenda">
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select></td>
                      <td> <label class="pt-2 mb-0"  for="admin-e-1">Profesori</label><br/>
                        <select class="text-xs  " id="admin-e-1" name="admin-e-1" placeholder="Profesori">
                            @foreach($admins as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                            @endforeach
                        </select><br/>
                        <label class="pt-2 mb-0"  for="subject-e-1">Lenda</label><br/>
                        <select class="text-xs" id="subject-e-1" name="subject-e-1" placeholder="Lenda">
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select></td>
                      <td> <label class="pt-2 mb-0"  for="admin-p-1">Profesori</label><br/>
                        <select class="text-xs  " id="admin-p-1" name="admin-p-1" placeholder="Profesori">
                            @foreach($admins as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                            @endforeach
                        </select><br/>
                        <label class="pt-2 mb-0"  for="subject-p-1">Lenda</label><br/>
                        <select class="text-xs" id="subject-p-1" name="subject-p-1" placeholder="Lenda">
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td> <label class="pt-2 mb-0"  for="admin-h-2">Profesori</label><br/>
                          <select class="text-xs  " id="admin-h-2" name="admin-h-2" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-h-2">Lenda</label><br/>
                          <select class="text-xs" id="subject-h-2" name="subject-h-2" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mr-2">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mr-2" name="admin-mr-2" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mr-2">Lenda</label><br/>
                          <select class="text-xs" id="subject-mr-2" name="subject-mr-2" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mk-2">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mk-2" name="admin-mk-2" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mk-2">Lenda</label><br/>
                          <select class="text-xs" id="subject-mk-2" name="subject-mk-2" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-e-2">Profesori</label><br/>
                          <select class="text-xs  " id="admin-e-2" name="admin-e-2" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-e-2">Lenda</label><br/>
                          <select class="text-xs" id="subject-e-2" name="subject-e-2" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-p-2">Profesori</label><br/>
                          <select class="text-xs  " id="admin-p-2" name="admin-p-2" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-p-2">Lenda</label><br/>
                          <select class="text-xs" id="subject-p-2" name="subject-p-2" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td> <label class="pt-2 mb-0"  for="admin-h-3">Profesori</label><br/>
                          <select class="text-xs  " id="admin-h-3" name="admin-h-3" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-h-3">Lenda</label><br/>
                          <select class="text-xs" id="subject-h-3" name="subject-h-3" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mr-3">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mr-3" name="admin-mr-3" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mr-3">Lenda</label><br/>
                          <select class="text-xs" id="subject-mr-3" name="subject-mr-3" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mk-3">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mk-3" name="admin-mk-3" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mk-3">Lenda</label><br/>
                          <select class="text-xs" id="subject-mk-3" name="subject-mk-3" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-e-3">Profesori</label><br/>
                          <select class="text-xs  " id="admin-e-3" name="admin-e-3" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-e-3">Lenda</label><br/>
                          <select class="text-xs" id="subject-e-3" name="subject-e-3" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-p-3">Profesori</label><br/>
                          <select class="text-xs  " id="admin-p-3" name="admin-p-3" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-p-3">Lenda</label><br/>
                          <select class="text-xs" id="subject-p-3" name="subject-p-3" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td> <label class="pt-2 mb-0"  for="admin-h-4">Profesori</label><br/>
                          <select class="text-xs  " id="admin-h-4" name="admin-h-4" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-h-4">Lenda</label><br/>
                          <select class="text-xs" id="subject-h-4" name="subject-h-4" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mr-4">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mr-4" name="admin-mr-4" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mr-4">Lenda</label><br/>
                          <select class="text-xs" id="subject-mr-4" name="subject-mr-4" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mk-4">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mk-4" name="admin-mk-4" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mk-4">Lenda</label><br/>
                          <select class="text-xs" id="subject-mk-4" name="subject-mk-4" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-e-4">Profesori</label><br/>
                          <select class="text-xs  " id="admin-e-4" name="admin-e-4" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-e-4">Lenda</label><br/>
                          <select class="text-xs" id="subject-e-4" name="subject-e-4" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-p-4">Profesori</label><br/>
                          <select class="text-xs  " id="admin-p-4" name="admin-p-4" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-p-4">Lenda</label><br/>
                          <select class="text-xs" id="subject-p-4" name="subject-p-4" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                      </tr>
                      <tr>
                        <th scope="row">5</th>
                        <td> <label class="pt-2 mb-0"  for="admin-h-5">Profesori</label><br/>
                          <select class="text-xs  " id="admin-h-5" name="admin-h-5" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-h-5">Lenda</label><br/>
                          <select class="text-xs" id="subject-h-5" name="subject-h-5" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mr-5">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mr-5" name="admin-mr-5" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mr-5">Lenda</label><br/>
                          <select class="text-xs" id="subject-mr-5" name="subject-mr-5" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mk-5">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mk-5" name="admin-mk-5" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mk-5">Lenda</label><br/>
                          <select class="text-xs" id="subject-mk-5" name="subject-mk-5" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-e-5">Profesori</label><br/>
                          <select class="text-xs  " id="admin-e-5" name="admin-e-5" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-e-5">Lenda</label><br/>
                          <select class="text-xs" id="subject-e-5" name="subject-e-5" placeholder="Lenda">
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-p-5">Profesori</label><br/>
                          <select class="text-xs  " id="admin-p-5" name="admin-p-5" placeholder="Profesori">
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-p-5">Lenda</label><br/>
                          <select class="text-xs" id="subject-p-5" name="subject-p-5" placeholder="Lenda">

                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                      </tr>
                      <tr>
                        <th scope="row">6</th>
                        <td> <label class="pt-2 mb-0"  for="admin-h-6">Profesori</label><br/>
                          <select class="text-xs  " id="admin-h-6" name="admin-h-6" placeholder="Profesori">
                            <option value="jo">Jo</option>
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-h-6">Lenda</label><br/>
                          <select class="text-xs" id="subject-h-6" name="subject-h-6" placeholder="Lenda">
                            <option value="jo">Jo</option>
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mr-6">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mr-6" name="admin-mr-6" placeholder="Profesori">
                            <option value="jo">Jo</option>
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mr-6">Lenda</label><br/>
                          <select class="text-xs" id="subject-mr-6" name="subject-mr-6" placeholder="Lenda">
                            <option value="jo">Jo</option>
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-mk-6">Profesori</label><br/>
                          <select class="text-xs  " id="admin-mk-6" name="admin-mk-6" placeholder="Profesori">
                            <option value="jo">Jo</option>
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-mk-6">Lenda</label><br/>
                          <select class="text-xs" id="subject-mk-6" name="subject-mk-6" placeholder="Lenda">
                            <option value="jo">Jo</option>
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-e-6">Profesori</label><br/>
                          <select class="text-xs  " id="admin-e-6" name="admin-e-6" placeholder="Profesori">
                            <option value="jo">Jo</option>
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-e-6">Lenda</label><br/>
                          <select class="text-xs" id="subject-e-6" name="subject-e-6" placeholder="Lenda">
                            <option value="jo">Jo</option>
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                        <td> <label class="pt-2 mb-0"  for="admin-p-6">Profesori</label><br/>
                          <select class="text-xs  " id="admin-p-6" name="admin-p-6" placeholder="Profesori">
                            <option value="jo">Jo</option>
                              @foreach($admins as $admin)
                                  <option value="{{$admin->id}}">{{$admin->name}}</option>
                              @endforeach
                          </select><br/>
                          <label class="pt-2 mb-0"  for="subject-p-6">Lenda</label><br/>
                          <select class="text-xs" id="subject-p-6" name="subject-p-6" placeholder="Lenda">
                            <option value="jo">Jo</option>
                              @foreach($subjects as $subject)
                                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                          </select></td>
                      </tr>
                  </tbody>

            </table>
            <button class="btn btn-primary mt-3" type="submit">
              Ruaj
            </button>
          </div>
              </form>
    </div>
</div>
@endsection
