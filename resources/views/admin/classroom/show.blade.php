@extends('admin.layouts.app')
@section('title','Klasa')
@section('classroom','active')
@section('content')
<div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
            <a href="{{route('admin.classroom.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kthehu</a>
<h1 class="h3 mb-0 text-gray-800  ml-auto mr-auto">Klasa {{$classroom->class_name}}</h1>
              <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                ><i class="fas fa-download fa-sm text-white-50"></i> Gjenero
                Raportin</a
              >
            </div>

            <div class="row">


              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          Mungesat/Verejtjet
                        </div>
                      </div>
                      <div class="col-auto">
                          <a href="{{route('admin.notice.create',['classroom_id' => $classroom->id])}}"><i class="fas fa-edit fa-2x"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Lendet
                          </div>
                        </div>
                        <div class="col-auto">
                          <a href="{{route('admin.subject.create')}}"><i class="fas fa-edit fa-2x"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Notat
                          </div>
                        </div>
                        <div class="col-auto">
                          <a href="{{route('admin.grade.create',['classroom_id' => $classroom->id])}}"><i class="fas fa-edit fa-2x"></i></a>
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
                            Shto nxenes
                          </div>
                        </div>
                        <div class="col-auto">
                          <a href="{{route('admin.user.create',['classroom_id' => $classroom->id])}}"><i class="fas fa-edit fa-2x"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            </div>

          <!-- Begin Page Content -->
          <div class="container-fullwidth">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Ditari
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
                        <th>Emri dhe mbiemri</th>
                        <th>Periudha 1</th>
                        <th>Periudha 2</th>
                        <th>Periudha 3</th>
                        <th>Nota mesatare</th>
                        <th>Mungesat</th>
                        <th width="100px">Shiko / fshij</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Emri dhe mbiemri</th>
                        <th>Periudha 1</th>
                        <th>Periudha 2</th>
                        <th>Periudha 3</th>
                        <th>Nota mesatare</th>
                        <th>Mungesat</th>
                        <th width="100px">Shiko / fshij</th>
                      </tr>
                    </tfoot>
                    <tbody>
                        @foreach($classroom->students as $user)
                      <tr>
                        <td>{{$user->full_name}}</td>
                        <td>{{$user->first_period_average}}
                        <a href="#" data-toggle="modal" data-target="#periodOne{{$user->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <div class="modal fade" id="periodOne{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="periodOneLabel{{$user->id}}" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="periodOneLabel{{$user->id}}">Periudha e pare</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tbody>
                                            @foreach($user->first_period_grades as $grade)
                                            <tr>
                                                <th scope="col">{{$grade->subject->name}}</th>
                                                <th>{{$grade->grade}}</th>
                                                <th><a class="btn btn-primary btn-circle" href="{{route('admin.grade.edit',$grade->id)}}"><i class="far fa-edit"></i></a>
                                                    <form class="d-inline" id="delete{{$grade->id}}" method="POST" action="{{ route('admin.grade.destroy',$grade->id)}}" accept-charset="UTF-8">
                                                        {{ csrf_field() }}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                    </form>
                                                    <button type="submit" form="delete{{$grade->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                                </th>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        </td>
                        <td>{{$user->second_period_average}}
                            <a href="#" data-toggle="modal" data-target="#periodTwo{{$user->id}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <div class="modal fade" id="periodTwo{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="periodTwoLabel{{$user->id}}" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="periodTwoLabel{{$user->id}}">Periudha e dyte</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tbody>
                                                @foreach($user->second_period_grades as $grade)
                                                <tr>
                                                    <th scope="col">{{$grade->subject->name}}</th>
                                                    <th>{{$grade->grade}}</th>
                                                    <th><a class="btn btn-primary btn-circle" href="{{route('admin.grade.edit',$grade->id)}}"><i class="far fa-edit"></i></a>
                                                        <form class="d-inline" id="delete{{$grade->id}}" method="POST" action="{{ route('admin.grade.destroy',$grade->id)}}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input name="_method" type="hidden" value="DELETE">
                                                        </form>
                                                        <button type="submit" form="delete{{$grade->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                                    </th>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                          </table>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </td>
                        <td>{{$user->third_period_average}}
                            <a href="#" data-toggle="modal" data-target="#periodThree{{$user->id}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <div class="modal fade" id="periodThree{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="periodThreeLabel{{$user->id}}" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="periodThreeLabel{{$user->id}}">Periudha e trete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tbody>
                                                @foreach($user->third_period_grades as $grade)
                                                <tr>
                                                    <th scope="col">{{$grade->subject->name}}</th>
                                                    <th>{{$grade->grade}}</th>
                                                    <th><a class="btn btn-primary btn-circle" href="{{route('admin.grade.edit',$grade->id)}}"><i class="far fa-edit"></i></a>
                                                        <form class="d-inline" id="delete{{$grade->id}}" method="POST" action="{{ route('admin.grade.destroy',$grade->id)}}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input name="_method" type="hidden" value="DELETE">
                                                        </form>
                                                        <button type="submit" form="delete{{$grade->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                                    </th>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                          </table>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div></td>
                        <td>{{$user->average_grade}}</td>
                        <td>{{$user->all_absences}}
                            <a href="#" data-toggle="modal" data-target="#absences{{$user->id}}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <div class="modal fade" id="absences{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="absencesLabel{{$user->id}}" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="absencesLabel{{$user->id}}">Mungesat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="dataTable" class="table">
                                            <tbody>
                                                @foreach($user->absences as $notice)
                                                <tr>
                                                    <th scope="col">{{$notice->schedule->subject->name}}</th>
                                                    <th>{{$notice->schedule->date}}</th>
                                                    <th>@if($notice->arsyeshme ==2) Arsyeshme @else Pa Arsyeshme @endif</th>
                                                    <th><a class="btn btn-primary btn-circle" href="{{route('admin.notice.edit',$notice->id)}}"><i class="far fa-edit"></i></a>
                                                        <form class="d-inline" id="delete{{$notice->id}}" method="POST" action="{{ route('admin.notice.destroy',$notice->id)}}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input name="_method" type="hidden" value="DELETE">
                                                        </form>
                                                        <button type="submit" form="delete{{$notice->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                                    </th>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                          </table>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div></td>
                        <td><a class="btn btn-primary btn-circle" href="{{route('admin.user.edit',$user->id)}}"><i class="far fa-eye"></i></a>
                            <form class="d-inline" id="delete{{$user->id}}" method="POST" action="{{ route('admin.user.destroy',$user->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                </form>
                                <button type="submit" form="delete{{$user->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                <a href="#" class="btn btn-secondary btn-circle" data-toggle="modal" data-target="#parent{{$user->id}}">
                                    <i class="fas fa-user"></i>
                                </a>
                                <div class="modal fade" id="parent{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="parentLabel{{$user->id}}" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="parentLabel{{$user->id}}">Prinderit </h5>
                                        <a class="ml-3 btn btn-primary btn-circle" href="{{route('admin.user.create',['user_id' => $user->id])}}"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <table id="dataTable" class="table">
                                                <tbody>
                                                    @foreach($user->parents as $parent)
                                                    <tr>
                                                        <th scope="col">{{$parent->full_name}}</th>
                                                        <th>{{$parent->phone_nr}}</th>
                                                        <th><a class="btn btn-primary btn-circle" href="{{route('admin.user.edit',$parent->id)}}"><i class="far fa-edit"></i></a>
                                                            <form class="d-inline" id="delete{{$parent->id}}" method="POST" action="{{ route('admin.user.destroy',$parent->id)}}" accept-charset="UTF-8">
                                                                {{ csrf_field() }}
                                                                <input name="_method" type="hidden" value="DELETE">
                                                            </form>
                                                            <button type="submit" form="delete{{$parent->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                                        </th>
                                                    </tr>
                                                  @endforeach
                                                </tbody>
                                              </table>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                              </td>
                      </tr>
                      <!-- Modal -->

                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


@endsection
