<div class="row">
    <div class="col-md-12">
        <p> <span class="label label-default filter-cat">
                    <a style="color: inherit" href="{{route('posts.index')}}">
                        All</a>
                </span>
            @foreach($categories as $category)
                <span class="label label-default filter-cat">
                    <a style="color: inherit" href="{{route('categories.show',$category->id)}}">
                        {{$category->name}}</a>
                </span>
            @endforeach</p>
    </div>
</div>