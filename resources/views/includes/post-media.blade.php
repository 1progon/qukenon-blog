<div class="media">
    <h1 class="title">{{ $post->title }}</h1>

    {{--Meta--}}
    <div class="meta">
        <div>Опубликовано: {{ $post->created_at }}</div>
        @if( $post->created_at !== $post->updated_at)
            <div>Обновлено: {{ $post->updated_at }}</div>
        @endif
        <div>Автор: {{ $post->user->name }}</div>
    </div>


    <div class="content-block">
        <div class="content">
            <div class="thumbnail">

                <a href="/{{ $post->slug }}">
                    @php
                        $postFirstImage = $post->images()->first();
                    @endphp

                    @if( isset($postFirstImage))

                        <img src="{{ asset('storage/' . $postFirstImage->filepath) }}" alt="">

                    @else
                        <img src="https://increasify.com.au/wp-content/uploads/2016/08/default-image.png"
                             alt="default image">
                    @endif

                </a>


            </div>


            {{--Post description--}}
            <div class="description">
                {{ $post->description }}
            </div>
        </div>


        {{--Read post button--}}
        <div class="read-post-button">
            {{--<div class="btn">--}}
            <a class="btn" href="/{{ $post->slug }}">
                <span><img src="{{ asset('/images/arrow-right-white.svg') }}" alt=""></span>
            </a>
            {{--</div>--}}
        </div>


    </div>
</div>
