@extends('admin.layouts.app')
@section('title','Ndrysho Mesimdhenes')
@section('admin','active')
@section('content')
<!-- Page Heading -->
<div
class="d-sm-flex align-items-center justify-content-between mb-4"
>
<a href="{{route('admin.admin.index')}}" class="btn btn-secondary"
  ><i class="fas fa-arrow-left"></i> Kthehu</a
>
</div>

<!-- Content Row -->
<div class="row">
<div class="col-lg-7 col-md-12 ml-auto mr-auto">
       <form  method="POST" action="{{ route('admin.admin.update',$admin->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card ml-auto mr-auto p-4 border-left-danger">
            <h3>Ndrysho mesimdhenesin {{$admin->full_name}}</h3>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                    <label class="pt-2 mb-0">Emri</label><br />
                    <input id="name" name="Emri" value="{{$admin->first_name}}" required autofocus type="text" class=" @error('Emri') is-invalid @enderror"  placeholder="Emri"><br />
                    @if ($errors->has('Emri'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Emri i prindit</label><br />
                    <input id="fathers_name" name="Emri_Prindit" value="{{$admin->fathers_name }}" required autofocus type="text" class=" @error('Emri_Prindit') is-invalid @enderror"  placeholder="Emri i Prindit"><br />
                    @if ($errors->has('Emri_Prindit'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Emri_Prindit') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Mbiemri</label><br />
                    <input id="surname" name="Mbiemri" value="{{ $admin->surname}}" required autofocus type="text" class=" @error('Mbiemri') is-invalid @enderror"  placeholder="Mbiemri"><br />
                    @if ($errors->has('Mbiemri'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Mbiemri') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Gjinia</label><br />
                        <input type="radio" @if($admin->gender == "M") checked @endif  name="Gjinia" value="M" class="@error('Gjinia') is-invalid @enderror" checked id="gender1">
                        <label class="pt-2 mb-0" for="gender1">Mashkull</label>
                        <input type="radio" @if($admin->gender == "F") checked @endif name="Gjinia" value="F"  class="@error('Gjinia') is-invalid @enderror" id="gender2">
                        <label class="pt-2 mb-0" for="gender2">Femër</label><br />
                    @if ($errors->has('Gjinia'))
                          <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Gjinia') }}</small></strong>
                          </span>
                      @endif
                      <label class="pt-2 mb-0">Roli</label><br />
                      <select class="pl-5 pr-5 @error('Roli') is-invalid @enderror" id="role" name="Roli" placeholder="Roli">
                        @foreach($roles as $role)
                            <option  @if($admin->hasRole($role->name)) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('Roli'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Roli') }}</small></strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                    <label class="pt-2 mb-0">Data e lindjes</label><br />
                    <input id="birthday" name="Data_e_lindjes" value="{{$admin->birthday }}" required autofocus type="date" class=" @error('Data_e_lindjes') is-invalid @enderror"  placeholder="Data e lindjes"><br/>
                    @if ($errors->has('Data_e_lindjes'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Data_e_lindjes') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Vendbanimi</label><br />
                    <input id="residence" name="Vendbanimi" value="{{$admin->residence }}" required autofocus type="text" class=" @error('Vendbanimi') is-invalid @enderror"  placeholder="Vendbanimi"><br/>
                    @if ($errors->has('Vendbanimi'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Vendbanimi') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Adresa</label><br />
                    <input id="address" name="Adresa" value="{{ $admin->address }}" required autofocus type="text" class=" @error('Adresa') is-invalid @enderror"  placeholder="Adresa"><br/>
                    @if ($errors->has('Adresa'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Adresa') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Komuna</label><br />
                    <input id="city" name="Qyteti" value="{{ $admin->city }}" required autofocus type="text" class=" @error('Qyteti') is-invalid @enderror"  placeholder="Komuna"><br/>
                    @if ($errors->has('Qyteti'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Qyteti') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Nr. telefonit</label><br />
                    <input id="phone_nr" name="Nr_Telefonit" value="{{ $admin->phone_nr }}" required autofocus type="number" class=" @error('Nr_Telefonit') is-invalid @enderror"  placeholder="Nr Telefonit"><br/>
                    @if ($errors->has('Nr_Telefonit'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Nr_Telefonit') }}</small></strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-12 text-center">
                    <label class="pt-2 mb-0">Foto</label><br />
                    <input  id="photo" name="Foto" value="{{ old('Foto') }}"  type="file" class="border border-dark @error('Foto') is-invalid @enderror" placeholder="Foto"><br/>
                    @if ($errors->has('Foto'))
                        <span class="help-block">
                            <strong class="text-danger"><small>>{{ $errors->first('Foto') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">E-mail</label><br />
                    <input  id="email" name="email" value="{{ $admin->email}}" required type="email" class=" @error('email') is-invalid @enderror" placeholder="Email Adresa"><br/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong class="text-danger"><small>>{{ $errors->first('email') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Password</label><br />
                    <input id="password" name="password"  type="password" class=" @error('password') is-invalid @enderror"  placeholder="Password">

                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger"><small>{{ $errors->first('password') }}</small></strong>
                                    </span>
                                @endif<br />
                    <label class="pt-2 mb-0">Përsërit Password</label><br />
                    <input id="password-confirm" name="password_confirmation"  type="password" class=" @error('password') is-invalid @enderror" placeholder="Përsërit Password"><br />
                  </div>
                </div>
                <button class="btn btn-primary mt-3" type="submit">
                    Ruaj
                  </button>
              </div>
              </form>
    </div>
</div>
@endsection
