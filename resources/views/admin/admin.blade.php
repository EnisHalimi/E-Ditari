@extends('admin.layouts.app')
@section('title','Ballina')
@section('dashboard','active')
@section('content')
<div class="row bg-primary">
    <div
      class="col-md-6 d-flex align-items-center justify-content-center"
    >
      <div class="welcome-info welcome-section mt-auto mb-auto pt-5">
        <h1>Mir se vini ne platformen online</h1>
        <a
          class="navbar-brand d-flex align-items-center justify-content-center"
          href="index.html"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-lightbulb"></i>
          </div>
          <div class="sidebar-brand-text mx-3">E-Ditari</div>
        </a>
      </div>
    </div>
    <div class="col-md-6 welcome-right d-flex justify-content-center">
    <img src="{{asset('img/using_laptop.svg')}}" alt="" />
    </div>
  </div>

  <!-- Page Heading -->
  <div
    class="d-sm-flex align-items-center justify-content-between mb-4 mt-5"
  >
    <h1 class="h3 mb-0 text-gray-800">Raportet</h1>
    <a
      href="#"
      class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
      ><i class="fas fa-download fa-sm text-white-50"></i> Generate
      Report</a
    >
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{App\User::countUsers()}} <span>Nxenes</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-child fa-2x text-gray-600"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{App\Admin::countAdmins()}} <span>Mesimdhenes</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-tie fa-2x text-gray-600"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{App\School::countSchools()}} <span>Shkolla</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-school fa-2x text-gray-600"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{App\User::countParents()}} <span>Prinder</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-600"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
  </div>

  <!-- Content Row -->

  <div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
          class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
        >
          <h6 class="m-0 font-weight-bold text-primary">Perdorues</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
          class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
        >
          <h6 class="m-0 font-weight-bold text-primary">
            Te regjistruar
          </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i
              ><span > {{App\User::countMaleUsers()}}</span> Meshkuj
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i
              ><span>  {{App\User::countFemaleUsers()}}</span> Femra
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">

  </div>
</div>
@endsection
