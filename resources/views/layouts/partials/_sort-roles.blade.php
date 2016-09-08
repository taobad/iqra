<div class="row">
    <div class="col-md-12">
        <p> <span class="label label-default filter-cat">
                    <a style="color: inherit" href="{{route('users.index')}}">
                        All</a>
                </span>
            @foreach($roles as $role)
                <span class="label label-default filter-cat">
                    <a style="color: inherit" href="{{route('roles.show',$role->id)}}">
                        {{$role->name}}</a>
                </span>
            @endforeach</p>
    </div>
</div>
