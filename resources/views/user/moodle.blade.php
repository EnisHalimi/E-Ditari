@extends('layouts.app')
@section('title','Moodle')
@section('moodle','active')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ditari im</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Ditari
        </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            class="table table-bordered display"
            id="dataTable"
            width="100%"
            cellspacing="0"
          >
            <thead>
              <tr>
                <th>Lenda</th>
                <th>Ars. i lendes</th>
                <th colspan="3">Periudha 1</th>
                <th colspan="3">Periudha 2</th>
                <th colspan="3">Periudha 3</th>
                <th colspan="3">N.P</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Lenda</th>
                <th>Ars. i lendes</th>
                <th colspan="3">Periudha 1</th>
                <th colspan="3">Periudha 2</th>
                <th colspan="3">Periudha 3</th>
                <th colspan="3">N.P</th>
              </tr>
            </tfoot>
            <tbody>
                @foreach($user->classroom->subjects as $schedule)
              <tr>
                <td>{{$schedule->subject->name}}</td>
                <td>{{$schedule->admin->name}}</td>
                @if(App\Grade::getGradeCount($schedule->subject->id,1, $user->id,$schedule->admin->id) == 2)
                    @foreach(App\Grade::getGrades($schedule->subject->id,1,$user->id, $schedule->admin->id) as $grade)
                        <td>{{$grade->grade}}</td>
                    @endforeach
                    <td>{{App\Grade::getPeriodAverage($schedule->subject->id,1,$user->id, $schedule->admin->id)}}</td>
                @elseif(App\Grade::getGradeCount($schedule->subject->id,1, $user->id,$schedule->admin->id) == 1)
                    @foreach(App\Grade::getGrades($schedule->subject->id,1, $user->id,$schedule->admin->id) as $grade)
                        <td>{{$grade->grade}}</td>
                    @endforeach
                    <td></td>
                    <td>{{App\Grade::getPeriodAverage($schedule->subject->id,1,$user->id, $schedule->admin->id)}}</td>
                @else
                <td> </td>
                <td> </td>
                <td> </td>
                @endif
                @if(App\Grade::getGradeCount($schedule->subject->id,2, $user->id,$schedule->admin->id) == 2)
                    @foreach(App\Grade::getGrades($schedule->subject->id,2, $user->id,$schedule->admin->id) as $grade)
                        <td>{{$grade->grade}}</td>
                    @endforeach
                    <td>{{App\Grade::getPeriodAverage($schedule->subject->id,2,$user->id, $schedule->admin->id)}}</td>
                @elseif(App\Grade::getGradeCount($schedule->subject->id,2,$user->id, $schedule->admin->id) == 1)
                    @foreach(App\Grade::getGrades($schedule->subject->id,2, $user->id,$schedule->admin->id) as $grade)
                        <td>{{$grade->grade}}</td>
                    @endforeach
                    <td></td>
                    <td>{{App\Grade::getPeriodAverage($schedule->subject->id,2,$user->id, $schedule->admin->id)}}</td>
                @else
                <td> </td>
                <td> </td>
                <td> </td>
                @endif
                @if(App\Grade::getGradeCount($schedule->subject->id,3,$user->id, $schedule->admin->id) == 2)
                    @foreach(App\Grade::getGrades($schedule->subject->id,3, $user->id,$schedule->admin->id) as $grade)
                        <td>{{$grade->grade}}</td>
                    @endforeach
                    <td>{{App\Grade::getPeriodAverage($schedule->subject->id,3,$user->id, $schedule->admin->id)}}</td>
                @elseif(App\Grade::getGradeCount($schedule->subject->id,3, $user->id,$schedule->admin->id) == 1)
                    @foreach(App\Grade::getGrades($schedule->subject->id,3,$user->id, $schedule->admin->id) as $grade)
                        <td>{{$grade->grade}}</td>
                    @endforeach
                    <td></td>
                    <td>{{App\Grade::getPeriodAverage($schedule->subject->id,3,$user->id, $schedule->admin->id)}}</td>
                @else
                <td> </td>
                <td> </td>
                <td> </td>
                @endif
                <td>{{App\Grade::getFinalGrade($schedule->subject->id,$user->id,$schedule->admin->id)}} </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              Mungesat
            </h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                class="table table-bordered display"
                id="dataTable"
                width="100%"
                cellspacing="0"
              >
                <thead>
                  <tr>
                    <th>Te arsyeshme</th>
                    <th>Te paarsyeshme</th>
                    <th>Total</th>
                  </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>{{App\Notice::getNoticesCount($user->id,true)}}</th>
                        <th>{{App\Notice::getNoticesCount($user->id,false)}}</th>
                        <th>{{(App\Notice::getNoticesCount($user->id,true) + App\Notice::getNoticesCount($user->id,false))}}</th>
                      </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
  @endsection
