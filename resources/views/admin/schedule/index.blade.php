@extends('admin.layouts.app')
@section('title','Orari')
@section('schedule','active')
@section('content')

<div class="container">
    <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h1 class="h3 mb-0 text-gray-800">Menaxho Orarin</h1>
              <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                ><i class="fas fa-download fa-sm text-white-50"></i> Gjenero
                Raportin</a
              >
            </div>

            <!-- Content Row -->
            <div class="row">
            @foreach($classrooms as $classroom)
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                        >
                          Klasa {{$classroom->class_name}}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          Kujd. {{$classroom->admin->full_name}}
                        </div>
                      </div>
                      <div class="col-auto">
                      <a href="{{route('admin.schedule.show',$classroom->id)}}"
                          ><i class="fas fa-edit fa-2x"></i
                        ></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          Shto Orarin
                        </div>
                      </div>
                      <div class="col-auto">
                        <a href="{{route('admin.schedule.create')}}"
                          ><i class="fas fa-folder-plus fa-2x"></i
                        ></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
