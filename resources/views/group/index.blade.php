@extends('layouts.app')

@section('title','|All Groups')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <h1>All group</h1>
        </div>

        <div class="col-md-2 app-button">
              <a href="{{route('group.create')}}" class="btn btn-primary btn-lg btn-block"> Add New Group</a>
        </div>
        <div class="col-md-2 app-button">
             <p><button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Search Groups</button>
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
                    <h4 class="modal-title">Search Groups By Name</h4>
                  </div>
                  <div class="modal-body">
                  <!--<p><input type="text" name="search" id="searchtext" class="form-control"><br></p>-->
                    {!! Form::open(array('route' => 'group.search')) !!}
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
                    <th>Display Name</th>
                    <th>Description</th>
                    <th></th>
                </thead>
                @if($groups)
                <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <th>{{$group->id}}</th>
                            <td>{{$group->display_name}}</td>
                            <td>{{$group->desctiption}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('group.show',$group->id)}}">View</a> <a class="btn btn-primary btn-sm" href="{{route('group.edit',$group->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
                @endif
            </table>

            <div class="text-center">
                {{--{!! $groups->links() !!}--}}
            </div>
        </div>
    </div>
@stop
