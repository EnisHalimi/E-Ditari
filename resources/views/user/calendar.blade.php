@extends('layouts.app')
@section('title','Calendar')
@section('calendar','active')
@section('content')


  <div class="container-fullwidth">
    <div class="col-12">
        @if(Auth()->user()->notifications_count != 0)
        <ul id="notifications-list" class="list-group">
        @foreach(Auth()->user()->notifications as $not)
                  <li id="not{{$not->id}}" class="list-group-item p-0 mb-2 border border-dark">
                    <div class="dropdown-item d-flex align-items-center px-0" >
                      <div class="mx-3">
                        <div class="icon-circle">
                          <i class="fas fa-bell text-dark"></i>
                        </div>
                      </div>
                      <div id="notifications">
                        <div class="small text-gray-500">{{$not->created_at}}</div>
                        <span class="font-weight-bold">{{$not->description}}!</span>
                      </div>
                      <div class="ml-auto mr-3">
                          <a class="close" href="#" id="deleteNotification" onclick ="markAsRead({{$not->id}})" >
                              <span>&times;</span>
                          </a>
                      </div>
                    </div>
                  </li>
                    @endforeach
        </ul>
        @endif
      <div id="calendar"></div>
    </div>
  </div>
  @endsection
