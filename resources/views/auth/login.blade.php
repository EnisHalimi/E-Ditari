@extends('layouts.app')
@section('title','Login & Registration')
@section('login-content')
<div class="container">
<div class="forms-container">
  <div class="signin-signup">
    <form  class="sign-in-form" action="{{route('login')}}" method="POST" id="login-form">
        @csrf
      <h2 class="title">Nxenes</h2>
      <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input id="email" type="email"  placeholder="Email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

      </div>
      @error('email')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
      <div class="input-field">
        <i class="fas fa-lock"></i>
        <input id="password"  placeholder="Password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

      </div>
      @error('password')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
      <input type="submit" value="Login" class="btn solid" />
    </form>
    <form action="{{route('admin.login')}}" method="POST" class="sign-up-form" id="admin-login">
        @csrf
      <h2 class="title">Staf</h2>
      <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input id="email" type="email"  placeholder="Email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

      </div>
      @error('email')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
        @enderror
      <div class="input-field">
        <i class="fas fa-lock"></i>
        <input id="password"  placeholder="Password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

      </div>
      @error('password')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
        @enderror
      <input type="submit" class="btn" value="Kyqu" />
    </form>
  </div>
</div>

<div class="panels-container">
  <div class="panel left-panel">
    <div class="content">
      <h3>Staf apo mesimdhenes ?</h3>
      <p>
        Nese jeni staf apo mesimdhenes ju lutem me poshte gjeni butonin
        per tu kyqur ne platforme.
      </p>
      <button class="btn transparent" id="sign-up-btn">
        Kyqu
      </button>
    </div>
    <img src="img/log.svg" class="image" alt="" />
  </div>
  <div class="panel right-panel">
    <div class="content">
      <h3>Nxenes apo prind ?</h3>
      <p>
        Nese jeni nxenes apo prind ju lutem me poshte gjeni butonin per tu
        kyqur ne platforme.
      </p>
      <button class="btn transparent" id="sign-in-btn">
        Kyqu
      </button>
    </div>
    <img src="img/register.svg" class="image" alt="" />
  </div>
</div>
</div>
@endsection
