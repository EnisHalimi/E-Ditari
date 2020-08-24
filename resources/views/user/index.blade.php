@extends('layouts.app')
@section('title','Student')
@section('profile','active')
@section('content')

    <div class="row">
      <div class="col-12">
        <span class="d-flex justify-content-end">
          <svg
            width="1em"
            height="1em"
            viewBox="0 0 16 16"
            class="bi bi-pencil-square"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
            />
            <path
              fill-rule="evenodd"
              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
            />
          </svg>
        </span>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <div class="card profile-picture" style="background-image: url({{asset('img/'.$user->photo)}});">
          <!-- <img class="profile-picture" src="img/profile.jpg" alt="Profile Picture" /> -->
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="info-box">
          <p class="mb-0">Emri dhe mbiemri i nxënësit</p>
        <h4>{{$user->first_name}} {{$user->surname}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Data e lindjes</p>
          <h4>{{$user->birthday_date}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Adresa</p>
          <h4>{{$user->address}}</h4>
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="info-box">
            <p class="mb-0">Vendi i lindjes</p>
            <h4>{{$user->residence}}</h4>
          </div>
        <div class="info-box">
          <p class="mb-0">Komuna</p>
          <h4>{{$user->city}}</h4>
        </div>
        <div class="info-box">
            <p class="mb-0">Shteti</p>
            <h4>R. e Kosovës</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <h3>{{$user->first_name}} {{$user->surname}}</h3>
        <p>Nxenes</p>
      </div>
    </div>
    <hr />
    <div class="row pb-3">
      <div class="col-md-6 col-sm-12">
        <div class="info-box">
          <p class="mb-0">Emri dhe mbiemri babait</p>
          <h4>{{$user->father_name}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Profesioni i babait</p>
          <h4>{{$user->father_job}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Adresa e babait</p>
          <h4>{{$user->father_address}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Numri i babait</p>
          <h4>{{$user->father_phone}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">E-mail adresa e babait</p>
          <h4>{{$user->father_email}}</h4>
        </div>
      </div>

      <div class="col-md-6 col-sm-12">
        <div class="info-box">
          <p class="mb-0">Emri dhe mbiemri i nënës</p>
          <h4>{{$user->mother_name}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Profesioni i nënës</p>
          <h4>{{$user->mother_job}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Adresa e nënës</p>
          <h4>{{$user->mother_address}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Numri i nënës</p>
          <h4>{{$user->mother_phone}}</h4>
        </div>
        <div class="info-box">
          <p class="mb-0">Email Adresa e nënës</p>
          <h4>{{$user->mother_email}}</h4>
        </div>
      </div>
    </div>
    <hr />
    <div class="row pb-4">
      <div class="col-12">
        <button
          class="btn btn-info"
          type="button"
          data-toggle="collapse"
          data-target="#collapseExample"
          aria-expanded="false"
          aria-controls="collapseExample"
        >
          Të dhënat në librin Amë
        </button>
      </div>
      <div class="col-12 collapse" id="collapseExample">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="info-box">
              <p class="mb-0">Emri dhe mbiemri i nxënësit</p>
              <h4>{{$user->full_name}}</h4>
            </div>
            <div class="info-box">
              <p class="mb-0">Data e lindjes</p>
              <h4>{{$user->birthday_date}}</h4>
            </div>
            <div class="info-box">
              <p class="mb-0">Adresa</p>
              <h4>{{$user->address}}</h4>
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="info-box">
                <p class="mb-0">Vendi i lindjes</p>
                <h4>{{$user->residence}}</h4>
              </div>
            <div class="info-box">
              <p class="mb-0">Komuna</p>
              <h4>{{$user->city}}</h4>
            </div>
            <div class="info-box">
              <p class="mb-0">Shteti</p>
              <h4>R. e Kosovës</h4>
            </div>

          </div>
        </div>
      </div>
    </div>
  @endsection
