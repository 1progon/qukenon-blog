<div class="media">

    <a href="/{{ $post->slug }}">
        @if( isset($related))
            <h4 class="title">{{ $post->title }}</h4>
        @else
            <h1 class="subtitle">{{ $post->title }}</h1>
        @endif
    </a>


    {{--Meta--}}
    <div class="meta">
        <div>Опубликовано: {{ $post->created_at }}</div>
        @if( $post->created_at !== $post->updated_at)
            <div>Обновлено: {{ $post->updated_at }}</div>
        @endif
        <div>Автор: {{ $post->user->name }}</div>
    </div>


    <div class="content">
        <div class="thumbnail">


            <a href="/{{ $post->slug }}">
                @php
                    $firstImage = $post->images()->first();
                @endphp

                @if( isset( $firstImage))
                    @php
                        $thumb = \App\Http\Controllers\PostsController::THUMB['small'];
                        $imagePath = $firstImage->folder . '/' . $thumb['str'] . '_' . $firstImage->filename;
                    @endphp


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
            <div>{{ $post->description }}</div>
        </div>
    </div>


    {{--Read post button--}}
    <div class="read-post-button">
        <a class="btn" href="/{{ $post->slug }}">
            <img src="{{ asset('/images/arrow-right-white.svg') }}" alt="">
        </a>
    </div>


</div>
