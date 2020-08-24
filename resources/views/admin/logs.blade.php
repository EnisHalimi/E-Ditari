@extends('admin.layouts.app')
@section('title','Klasa')
@section('dashboard','active')
@section('content')
<div class="container-fullwidth">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Aktiviteti
        </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            class="table table-bordered"
            id="dataTable"
            width="100%"
            cellspacing="0"
          >
            <thead>
              <tr>
                <th>Aktiviteti</th>
                <th>Subjekti</th>
                <th>Ndryshuesi</th>
                <th>Shiko</th>
              </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
              <tr>
                <td>{{Str::substr($activity->description, 0, 7)}}</td>
                <td>@if($activity->subject_type == "App\User") Nxenes
                    @elseif($activity->subject_type == "App\School") Shkolla
                    @elseif($activity->subject_type == "App\Subject") Lenda
                    @elseif($activity->subject_type == "App\Classroom") Klasa
                    @elseif($activity->subject_type == "App\Grade") Nota
                    @elseif($activity->subject_type == "App\Notice") Munges/Veretje
                    @elseif($activity->subject_type == "App\Role") Roli
                    @elseif($activity->subject_type == "App\Schedule") Orari
                    @elseif($activity->subject_type == "App\Admin") Stafi
                    @else @endif
                </td>
                <td>@if($activity->causer == "App\Admin")
                    {{App\Admin::getFullName($activity->causer_id)}}
                    @elseif($activity->causer == "App\User")
                    {{App\User::getFullName($activity->causer_id)}}
                    @else
                    Ska
                    @endif</td>
                <td><button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#exampleModal{{$activity->id}}">
                    <i class="fa fa-eye"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal{{$activity->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Shiko</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            @if($activity->subject_type == "App\User")
                             <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="col">Emri Mbiemri</th>
                                    <th>{{ $activity->properties['attributes']['first_name']}} {{$activity->properties['attributes']['fathers_name']}} {{$activity->properties['attributes']['surname']}}</th>
                                  </tr>
                                  <tr>
                                    <th scope="col">Ditelindja</th>
                                    <td>{{ $activity->properties['attributes']['birthday']}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Adresa</th>
                                    <td>{{ $activity->properties['attributes']['address']}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Qyteti</th>
                                    <td>{{ $activity->properties['attributes']['city']}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Banimi</th>
                                    <td>{{ $activity->properties['attributes']['residence']}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Nr Tel</th>
                                    <td>{{ $activity->properties['attributes']['phone_nr']}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Statusi</th>
                                    <td>{{ $activity->properties['attributes']['status']}} </td>
                                  </tr>
                                </tbody>
                              </table>
                            @elseif($activity->subject_type == "App\School")
                            <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="col">Emri</th>
                                    <th>{{ $activity->properties['attributes']['name']}}</th>
                                  </tr>
                                  <tr>
                                    <th scope="col">Qyteti</th>
                                    <td>{{ $activity->properties['attributes']['city']}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Adresa</th>
                                    <td>{{ $activity->properties['attributes']['address']}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Niveli</th>
                                    <td>{{ $activity->properties['attributes']['level']}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            @elseif($activity->subject_type == "App\Subject")
                            <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="col">Emri</th>
                                    <th>{{ $activity->properties['attributes']['name']}}</th>
                                  </tr>
                                  <tr>
                                    <th scope="col">Viti</th>
                                    <td>{{ $activity->properties['attributes']['year']}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            @elseif($activity->subject_type == "App\Classroom")
                            <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="col">Viti</th>
                                    <th>{{ $activity->properties['attributes']['year']}}</th>
                                  </tr>
                                  <tr>
                                    <th scope="col">Paralelja</th>
                                    <td>{{ $activity->properties['attributes']['parallel']}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Kujdestari</th>
                                    <td>    {{App\Admin::getFullName($activity->properties['attributes']['admin_id'])}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            @elseif($activity->subject_type == "App\Grade")
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="col">Nxenesi</th>
                                        <td>{{App\User::getFullName($activity->properties['attributes']['user_id'])}}</td>
                                      </tr>
                                  <tr>
                                    <tr>
                                        <th scope="col">Lenda</th>
                                        <td>{{App\Subject::getName($activity->properties['attributes']['subject_id'])}}</td>
                                      </tr>
                                  <tr>
                                    <tr>
                                        <th scope="col">Profesori</th>
                                        <td>    {{App\Admin::getFullName($activity->properties['attributes']['admin_id'])}}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Klasa</th>
                                        <td>    {{App\Classroom::getName($activity->properties['attributes']['classroom_id'])}}</td>
                                      </tr>
                                    <th scope="col">Nota</th>
                                    <th>{{ $activity->properties['attributes']['grade']}}</th>
                                  </tr>
                                  <tr>
                                    <th scope="col">Periudha</th>
                                    <td>{{ $activity->properties['attributes']['period']}}</td>
                                  </tr>

                                </tbody>
                              </table>
                            @elseif($activity->subject_type == "App\Notice")
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="col">Nxenesi</th>
                                        <td>{{App\User::getFullName($activity->properties['attributes']['user_id'])}}</td>
                                      </tr>
                                  <tr>
                                    <tr>
                                        <th scope="col">Orari</th>
                                        <td>{{App\Schedule::getName($activity->properties['attributes']['schedule_id'])}}</td>
                                      </tr>
                                  <tr>
                                  <tr>
                                    <th scope="col">Pershkrimi</th>
                                    <td>{{ $activity->properties['attributes']['description']}}</td>
                                  </tr>

                                </tbody>
                              </table>
                            @elseif($activity->subject_type == "App\Role")
                            <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="col">Emri</th>
                                    <th>{{ $activity->properties['attributes']['name']}}</th>
                                  </tr>
                                </tbody>
                              </table>
                            @elseif($activity->subject_type == "App\Schedule")
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="col">Lenda</th>
                                        <td>{{App\Subject::getName($activity->properties['attributes']['subject_id'])}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Profesori</th>
                                        <td>{{App\Admin::getFullName($activity->properties['attributes']['admin_id'])}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Klasa</th>
                                        <td>    {{App\Classroom::getName($activity->properties['attributes']['classroom_id'])}}</td>
                                    </tr>
                                        <th scope="col">Data</th>
                                        <td>{{ $activity->properties['attributes']['date']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Periudha</th>
                                        <td>{{$activity->properties['attributes']['time']}}</td>
                                    </tr>
                                </tbody>
                              </table>
                            @elseif($activity->subject_type == "App\Admin")
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="col">Emri Mbiemri</th>
                                        <td>{{ $activity->properties['attributes']['first_name']}} {{$activity->properties['attributes']['fathers_name']}} {{$activity->properties['attributes']['surname']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Ditelindja</th>
                                        <td>{{ $activity->properties['attributes']['birthday']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Adresa</th>
                                        <td>{{ $activity->properties['attributes']['address']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Qyteti</th>
                                        <td>{{ $activity->properties['attributes']['city']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Banimi</th>
                                        <td>{{ $activity->properties['attributes']['residence']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Nr Tel</th>
                                        <td>{{ $activity->properties['attributes']['phone_nr']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Grada</th>
                                        <td>{{ $activity->properties['attributes']['grade']}} </td>
                                    </tr>
                                </tbody>
                            </table>
                            @else @endif
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
