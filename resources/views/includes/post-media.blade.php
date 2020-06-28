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

                @php
                    $firstImage = $post->images()->first();

                    $thumb = \App\Http\Controllers\PostsController::THUMB['small'];

                    $imagePath = $firstImage->folder . '/' . $thumb['str'] . '_' . $firstImage->filename;
                @endphp

                <a href="/{{ $post->slug }}">

                    @if( isset( $firstImage))
                        <img src="{{ asset('storage/' . $imagePath )}}"
                             alt=""
                             width="{{ $thumb['w'] }}"
                             height="{{ $thumb['h'] }}">
                    @else
                        <img src="{{ asset('images/default-image.jpg') }}" alt="default image">
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
