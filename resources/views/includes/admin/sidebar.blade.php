<div class="list-group">
    <a class="list-group-item list-group-item-action active"
       href="{{ route('post.create')}}">
        Add Post
    </a>

    @isset($postId)
        <a class="list-group-item list-group-item-action"
           href="{{ route('post.edit', [$postId])}}">
            Edit Post
        </a>
    @endisset


    {{--<a class="list-group-item list-group-item-action"--}}
    {{--   href="{{ route('user.edit', [ Auth::user() ])}}">--}}
    {{--    Edit User--}}
    {{--</a>--}}
</div>
