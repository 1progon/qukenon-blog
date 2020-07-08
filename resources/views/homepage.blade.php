@extends('layouts.layout')



@section('main')



    <div class="container">

        @php
            use App\Post;
            use App\Http\Controllers\PostsController;

            $stopShowFeatured = false;
            $posts = Post::latest()->paginate(15);

            if ($posts->count() <1 ) {
                $stopShowFeatured = true;

            }


            if(request()->has('page') && request()->page  > 1) {
                $stopShowFeatured = true;
            }

            $thumb = PostsController::THUMB;
        @endphp


        @if( !$stopShowFeatured)
            <div class="featured-posts-grid">

                {{--Left side--}}
                <div class="left-side">

                    @php
                        $latestPost = Arr::pull($posts, 0);

                        $latestImage = $latestPost->images()->first();

                        if(isset($latestImage)) {
                            $imagePath = $latestImage->folder . '/' .  $latestImage->filename;
                        }


                    @endphp

                    <a href="{{ route('post.front.show', [$latestPost->slug, $latestPost->id]) }}">
                        <div class="image-wrapper">
                            @if( isset( $latestImage))
                                <img
                                    src="{{ asset('storage/' . $imagePath) }}"
                                    alt="картинка к записи {{ $latestPost->title }}">

                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="default image">
                            @endif

                        </div>

                        <div class="description">
                            <div class="title">{{ $latestPost->title }}</div>
                            <div class="text">{{ $latestPost->description }}</div>
                            <div class="meta">Создано: {{ $latestPost->created_at }},
                                обновлено: {{ $latestPost->updated_at}}</div>
                        </div>
                    </a>
                </div>


                {{--Right side--}}
                <div class="right-side">
                    @for( $i = 1; $i < 5; $i++)

                        @php
                            $post = Arr::pull($posts, $i);

                            if(!$post) {
                                break;
                            }

                            $image = $post->images()->first();
                            if(isset($image)) {
                                $imagePath = $image->folder . '/' . $thumb['small']['str']. '_' . $image->filename;
                            }
                        @endphp



                        <a href="{{ route('post.front.show', [$post->slug, $post->id]) }}">
                            <div class="description">
                                <div class="title">{{ $post->title }}</div>
                                <div class="text">{{ Str::limit($post->description, 80) }}</div>
                                <div class="meta">Создано: {{ $post->created_at }},
                                    обновлено: {{ $post->updated_at}}</div>
                            </div>

                            <div class="image-wrapper">
                                @if( isset($image))
                                    <img
                                        src="{{ asset('storage/' . $imagePath) }}"
                                        alt="картинка к записи {{ $post->title }}"
                                        width="{{ $thumb['small']['w'] }}"
                                        height="{{ $thumb['small']['h'] }}">
                                @else
                                    <img src="{{ asset('images/default-image.jpg') }}" alt="default image">
                                @endif


                            </div>
                        </a>


                    @endfor


                    {{--                @forelse( $posts as $post)--}}
                    {{--                    @php--}}
                    {{--                        $image = $post->images()->first();--}}
                    {{--                        $imagePath = $image->folder . '/' . $thumb['small']['str']. '_' . $image->filename;--}}
                    {{--                    @endphp--}}



                    {{--                    <a href="#">--}}
                    {{--                        <div class="description">--}}
                    {{--                            <div class="title">{{ $post->title }}</div>--}}
                    {{--                            <div class="text">{{ Str::limit($post->description, 80) }}</div>--}}
                    {{--                            <div class="meta">Создано: {{ $post->created_at }},--}}
                    {{--                                обновлено: {{ $post->updated_at}}</div>--}}
                    {{--                        </div>--}}

                    {{--                        <div class="image-wrapper">--}}
                    {{--                            <img--}}
                    {{--                                src="{{ asset('storage/' . $imagePath) }}"--}}
                    {{--                                alt="картинка к записи {{ $post->title }}"--}}
                    {{--                                width="{{ $thumb['small']['w'] }}"--}}
                    {{--                                height="{{ $thumb['small']['h'] }}">--}}
                    {{--                        </div>--}}
                    {{--                    </a>--}}
                    {{--                @empty--}}
                    {{--                @endforelse--}}


                </div>
            </div>

        @endif


        <div class="recent-posts">
            <div class="post-media-list">
                <h3 class="title">Свежие записи</h3>
                @forelse( $posts as $post)
                    @include('includes.post-media')

                @empty
                @endforelse

                {{ $posts->links() }}
            </div>
        </div>
    </div>

@endsection

