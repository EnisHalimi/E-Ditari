@extends('admin.layouts.app')
@section('title','Shto Nxenes')
@section('classroom','active')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <form  method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card ml-auto mr-auto p-4 border-left-danger">
                <h3>Shto nxenes</h3>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                    <label class="pt-2 mb-0">Emri</label><br />
                    <input id="name" name="Emri" value="{{ old('Emri') }}" required autofocus type="text" class=" @error('Emri') is-invalid @enderror"  placeholder="Emri"><br />
                    @if ($errors->has('Emri'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Emri i prindit</label><br />
                    <input id="fathers_name" name="Emri_Prindit" value="{{ old('Emri_Prindit') }}" required autofocus type="text" class=" @error('Emri_Prindit') is-invalid @enderror"  placeholder="Emri i Prindit"><br />
                    @if ($errors->has('Emri_Prindit'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Emri_Prindit') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Mbiemri</label><br />
                    <input id="surname" name="Mbiemri" value="{{ old('Mbiemri') }}" required autofocus type="text" class=" @error('Mbiemri') is-invalid @enderror"  placeholder="Mbiemri"><br />
                    @if ($errors->has('Mbiemri'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Mbiemri') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Gjinia</label><br />
                        <input type="radio"  name="Gjinia" value="M" class="@error('Gjinia') is-invalid @enderror" checked id="gender1">
                        <label class="pt-2 mb-0" for="gender1">Mashkull</label>
                        <input type="radio"  name="Gjinia" value="F"  class="@error('Gjinia') is-invalid @enderror" id="gender2">
                        <label class="pt-2 mb-0" for="gender2">Femër</label><br />
                    @if ($errors->has('Gjinia'))
                          <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Gjinia') }}</small></strong>
                          </span>
                      @endif
                    <label class="pt-2 mb-0">Klasa</label><br />
                    <select class="pl-5 pr-5 @error('Klasa') is-invalid @enderror" id="class" name="Klasa" placeholder="Klasa">
                        @foreach($classrooms as $classroom)
                            <option value="{{$classroom->id}}">{{$classroom->year}}/{{$classroom->parallel}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('Klasa'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Klasa') }}</small></strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                    <label class="pt-2 mb-0">Data e lindjes</label><br />
                    <input id="birthday" name="Data_e_lindjes" value="{{ old('Data_e_lindjes') }}" required autofocus type="date" class=" @error('Data_e_lindjes') is-invalid @enderror"  placeholder="Data e lindjes"><br/>
                    @if ($errors->has('Data_e_lindjes'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Data_e_lindjes') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Vendbanimi</label><br />
                    <input id="residence" name="Vendbanimi" value="{{ old('Vendbanimi') }}" required autofocus type="text" class=" @error('Vendbanimi') is-invalid @enderror"  placeholder="Vendbanimi"><br/>
                    @if ($errors->has('Vendbanimi'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Vendbanimi') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Adresa</label><br />
                    <input id="address" name="Adresa" value="{{ old('Adresa') }}" required autofocus type="text" class=" @error('Adresa') is-invalid @enderror"  placeholder="Adresa"><br/>
                    @if ($errors->has('Adresa'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Adresa') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Komuna</label><br />
                    <input id="city" name="Qyteti" value="{{ old('Qyteti') }}" required autofocus type="text" class=" @error('Qyteti') is-invalid @enderror"  placeholder="Komuna"><br/>
                    @if ($errors->has('Qyteti'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Qyteti') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Nr. telefonit</label><br />
                    <input id="phone_nr" name="Nr_Telefonit" value="{{ old('Nr_Telefonit') }}" required autofocus type="number" class=" @error('Nr_Telefonit') is-invalid @enderror"  placeholder="Nr Telefonit"><br/>
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
                    <input  id="email" name="email" value="{{ old('email') }}" required type="email" class=" @error('email') is-invalid @enderror" placeholder="Email Adresa"><br/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong class="text-danger"><small>>{{ $errors->first('email') }}</small></strong>
                        </span>
                    @endif
                    <label class="pt-2 mb-0">Password</label><br />
                    <input id="password" name="password" required type="password" class=" @error('password') is-invalid @enderror"  placeholder="Password">

                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger"><small>{{ $errors->first('password') }}</small></strong>
                                    </span>
                                @endif<br />
                    <label class="pt-2 mb-0">Përsërit Password</label><br />
                    <input id="password-confirm" name="password_confirmation" required type="password" class=" @error('password') is-invalid @enderror" placeholder="Përsërit Password"><br />
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
