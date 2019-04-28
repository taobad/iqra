@extends('layouts.app')

@section('title','|All Users')

@section('content')
    @include('layouts.partials._sort-roles')
    <div class="row">
        <div class="col-md-7">
            <h1>All users</h1>
        </div>

        <div class="col-md-2 app-button">
              <a href="{{route('users.create')}}" class="btn btn-primary btn-lg btn-block"> Add New User</a>
        </div>
        <div class="col-md-2 app-button">
             <p><button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Search Users</button>
        </div>

        <div class="col-md-12">
            <hr>
                  <!-- Modal -->
            <div id="myModal" class="modal fade col-md-6 col-md-offset-3" role="dialog">
              <div class="modal-dialog">

               <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Search Users By Name</h4>
                  </div>
                  <div class="modal-body">
                  <!--<p><input type="text" name="search" id="searchtext" class="form-control"><br></p>-->
                    {!! Form::open(array('route' => 'users.search')) !!}
                      {{Form::text('name',null,['class'=>'form-control'])}}
                  </div>
                  <div class="modal-footer">
                      {{Form::submit('Search',['class' => 'btn btn-primary', 'required'=> 'required'])}}
                      {{Form::button('Close',['class' => 'btn btn-danger','data-dismiss' => 'modal'])}}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Roles</th>
                    <th></th>
                </thead>
                @if($users)
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <td>{{$user->lastname}}&nbsp{{$user->firstname}}</td>
                            <td>
                              @foreach($user->roles as $role)
                                <span class="label label-default filter-cat">
                                  <a style="color: inherit" href="{{route('roles.show',$role->id)}}">
                                      {{$role->name}}</a> </span>
                              @endforeach
                            </td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('users.show',$user->id)}}">View</a> <a class="btn btn-primary btn-sm" href="{{route('users.edit',$user->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
                @endif
            </table>

            <div class="text-center">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@stop
