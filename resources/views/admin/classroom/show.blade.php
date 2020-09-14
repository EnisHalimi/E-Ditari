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
                          Mungesat
                        </div>
                      </div>
                      <div class="col-auto">
                          <a href="{{route('admin.notice.create',['classroom_id' => $classroom->id, 'munges'=> true])}}"><i class="fas fa-edit fa-2x"></i></a>
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
                            Vëretjet
                          </div>
                        </div>
                        <div class="col-auto">
                          <a href="{{route('admin.notice.create',['classroom_id' => $classroom->id, 'munges'=> false])}}"><i class="fas fa-edit fa-2x"></i></a>
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
                <ul class="nav nav-tabs">
                    @foreach(App\Classroom::getSubjects(Auth::user()->id, $classroom->id) as $subject)
                        <li class="nav-item active "><a class="nav-link" data-toggle="tab" href="#content{{$subject->subject->id}}">{{$subject->subject->name}}</a></li>
                    @endforeach
                  </ul>

                  <div class="tab-content mt-2">
                    @foreach(App\Classroom::getSubjects(Auth::user()->id, $classroom->id) as $subject)
                  <div id="content{{$subject->subject->id}}" class="tab-pane fade">

                    <div class="table-responsive">
                        <table
                          class="display table table-bordered"
						  id="dataTable{{$subject->subject->id}}"
                          width="100%"
                          cellspacing="0"
                        >
                          <thead>
                            <tr>
                              <th>Emri dhe mbiemri</th>
                              <th colspan="3">Periudha 1</th>
                              <th colspan="3">Periudha 2</th>
                              <th colspan="3">Periudha 3</th>
                              <th >Mesatarja</th>
                              <th>Mungesat</th>
                              <th width="100px">Shiko / fshij</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <th>Emri dhe mbiemri</th>
                              <th colspan="3">Periudha 1</th>
                              <th colspan="3">Periudha 2</th>
                              <th colspan="3">Periudha 3</th>
                              <th>Mesatarja</th>
                              <th>Mungesat</th>
                              <th width="100px">Shiko / fshij</th>
                            </tr>
                          </tfoot>
                          <tbody>
                              @foreach($classroom->students as $user)
                            <tr>
                                <td>{{$user->full_name}}</td>
                                    @if(App\Grade::getGradeCount($subject->subject->id,1, $user->id,Auth::user()->id) == 2)
                                        @foreach(App\Grade::getGrades($subject->subject->id,1,$user->id, Auth::user()->id) as $grade)
                                            <td>{{$grade->grade}}</td>
                                        @endforeach
                                    @elseif(App\Grade::getGradeCount($subject->subject->id,1, $user->id,Auth::user()->id) == 1)
                                        @foreach(App\Grade::getGrades($subject->subject->id,1, $user->id,Auth::user()->id) as $grade)
                                            <td>{{$grade->grade}}</td>
                                        @endforeach
                                        <td></td>
                                    @else
                                        <td> </td>
                                        <td> </td>
                                    @endif
                                    <td>{{App\Grade::getPeriodAverage($subject->subject->id,1, $user->id,Auth::user()->id)}}
                                        <a href="#" data-toggle="modal" data-target="#periodOne{{$subject->subject->id}}{{$user->id}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="modal fade" id="periodOne{{$subject->subject->id}}{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="periodOneLabel{{$subject->subject->id}}{{$user->id}}" aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="periodOneLabel{{$subject->subject->id}}{{$user->id}}">Periudha e pare</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach(App\Grade::getGrades($subject->subject->id,1, $user->id,Auth::user()->id) as $grade)
                                                            <tr>
                                                                <th scope="col">{{$grade->subject->name}}</th>
                                                                <th>{{$grade->grade}}</th>
                                                                <th><a class="btn btn-primary btn-circle" href="{{route('admin.grade.edit',$grade->id)}}"><i class="far fa-edit"></i></a>
                                                                    <form class="d-inline" id="deleteGrade{{$subject->subject->name}}{{$grade->id}}" method="POST" action="{{ route('admin.grade.destroy',$grade->id)}}" accept-charset="UTF-8">
                                                                        {{ csrf_field() }}
                                                                        <input name="_method" type="hidden" value="DELETE">
                                                                    </form>
                                                                    <button type="submit" form="deleteGrade{{$subject->subject->name}}{{$grade->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
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
                                      @if(App\Grade::getGradeCount($subject->subject->id,2, $user->id,Auth::user()->id) == 2)
                                        @foreach(App\Grade::getGrades($subject->subject->id,2,$user->id, Auth::user()->id) as $grade)
                                            <td>{{$grade->grade}}</td>
                                        @endforeach
                                    @elseif(App\Grade::getGradeCount($subject->subject->id,2, $user->id,Auth::user()->id) == 1)
                                        @foreach(App\Grade::getGrades($subject->subject->id,2, $user->id,Auth::user()->id) as $grade)
                                            <td>{{$grade->grade}}</td>
                                        @endforeach
                                        <td></td>
                                    @else
                                        <td> </td>
                                        <td> </td>
                                    @endif
                                    <td>{{App\Grade::getPeriodAverage($subject->subject->id,2, $user->id,Auth::user()->id)}}
                                        <a href="#" data-toggle="modal" data-target="#periodTwo{{$subject->subject->name}}{{$user->id}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="modal fade" id="periodTwo{{$subject->subject->name}}{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="periodTwoLabel{{$subject->subject->name}}{{$user->id}}" aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="periodTwoLabel{{$subject->subject->name}}{{$user->id}}">Periudha e dyte</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach(App\Grade::getGrades($subject->subject->id,2, $user->id,Auth::user()->id) as $grade)
                                                            <tr>
                                                                <th scope="col">{{$grade->subject->name}}</th>
                                                                <th>{{$grade->grade}}</th>
                                                                <th><a class="btn btn-primary btn-circle" href="{{route('admin.grade.edit',$grade->id)}}"><i class="far fa-edit"></i></a>
                                                                    <form class="d-inline" id="deleteGrade{{$subject->subject->name}}{{$grade->id}}" method="POST" action="{{ route('admin.grade.destroy',$grade->id)}}" accept-charset="UTF-8">
                                                                        {{ csrf_field() }}
                                                                        <input name="_method" type="hidden" value="DELETE">
                                                                    </form>
                                                                    <button type="submit" form="deleteGrade{{$subject->subject->name}}{{$grade->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
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
                                      @if(App\Grade::getGradeCount($subject->subject->id,3, $user->id,Auth::user()->id) == 2)
                                      @foreach(App\Grade::getGrades($subject->subject->id,3,$user->id, Auth::user()->id) as $grade)
                                          <td>{{$grade->grade}}</td>
                                      @endforeach
                                    @elseif(App\Grade::getGradeCount($subject->subject->id,3, $user->id,Auth::user()->id) == 1)
                                      @foreach(App\Grade::getGrades($subject->subject->id,3, $user->id,Auth::user()->id) as $grade)
                                          <td>{{$grade->grade}}</td>
                                      @endforeach
                                      <td></td>
                                  @else
                                      <td> </td>
                                      <td> </td>
                                  @endif
                                  <td>{{App\Grade::getPeriodAverage($subject->subject->id,3, $user->id,Auth::user()->id)}}
                                      <a href="#" data-toggle="modal" data-target="#periodThree{{$subject->subject->name}}{{$user->id}}">
                                          <i class="fas fa-edit"></i>
                                      </a>
                                      <div class="modal fade" id="periodThree{{$subject->subject->name}}{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="periodThreeLabel{{$subject->subject->name}}{{$user->id}}" aria-hidden="true">
                                          <div class="modal-dialog " role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                              <h5 class="modal-title" id="periodThreeLabel{{$subject->subject->name}}{{$user->id}}">Periudha e trete</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              </div>
                                              <div class="modal-body">
                                                  <table class="table">
                                                      <tbody>
                                                          @foreach(App\Grade::getGrades($subject->subject->id,3, $user->id,Auth::user()->id) as $grade)
                                                          <tr>
                                                              <th scope="col">{{$grade->subject->name}}</th>
                                                              <th>{{$grade->grade}}</th>
                                                              <th><a class="btn btn-primary btn-circle" href="{{route('admin.grade.edit',$grade->id)}}"><i class="far fa-edit"></i></a>
                                                                  <form class="d-inline" id="deleteGrade{{$subject->subject->name}}{{$grade->id}}" method="POST" action="{{ route('admin.grade.destroy',$grade->id)}}" accept-charset="UTF-8">
                                                                      {{ csrf_field() }}
                                                                      <input name="_method" type="hidden" value="DELETE">
                                                                  </form>
                                                                  <button type="submit" form="deleteGrade{{$subject->subject->name}}{{$grade->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
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
                              <td>{{App\Grade::getFinalGrade($subject->subject->id,$user->id,Auth::user()->id)}} </td>
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
                                                              <form class="d-inline" id="deleteNotice{{$subject->subject->name}}{{$notice->id}}" method="POST" action="{{ route('admin.notice.destroy',$notice->id)}}" accept-charset="UTF-8">
                                                                  {{ csrf_field() }}
                                                                  <input name="_method" type="hidden" value="DELETE">
                                                              </form>
                                                              <button type="submit" form="deleteNotice{{$subject->subject->name}}{{$notice->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
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
                                  <form class="d-inline" id="deleteUser{{$subject->subject->name}}{{$user->id}}" method="POST" action="{{ route('admin.user.destroy',$user->id)}}" accept-charset="UTF-8">
                                          {{ csrf_field() }}
                                          <input name="_method" type="hidden" value="DELETE">
                                      </form>
                                      <button type="submit" form="deleteUser{{$subject->subject->name}}{{$user->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
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
                                                                  <form class="d-inline" id="deleteParent{{$subject->subject->name}}{{$parent->id}}" method="POST" action="{{ route('admin.user.destroy',$parent->id)}}" accept-charset="UTF-8">
                                                                      {{ csrf_field() }}
                                                                      <input name="_method" type="hidden" value="DELETE">
                                                                  </form>
                                                                  <button type="submit" form="deleteParent{{$subject->subject->name}}{{$parent->id}}" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
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
                    @endforeach
                  </div>

            </div>
          </div>


@endsection
