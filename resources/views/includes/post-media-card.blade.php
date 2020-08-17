<div class="media">

    <a href="{{ route('post.front.show', [$post, $post->id]) }}">
        @if( isset($related))
            <h4 class="title">{{ $post->title }}</h4>
        @else
            <h1 class="subtitle">{{ $post->title }}</h1>
        @endif
    </a>


    <div class="content">

        <div class="thumbnail">


            <a href="{{ route('post.front.show', [$post, $post->id]) }}">
                @php
                    $firstImage = $post->images()->first()
                @endphp

                @if( isset( $firstImage))
                    @php
                        $thumb = \App\Http\Controllers\Post\PostsController::THUMB['small'];
                        $imagePath = $firstImage->folder . '/' . $thumb['str'] . '_' . $firstImage->filename
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

            {{--Meta--}}
            <div class="meta">
                <div>Опубликовано: {{ $post->created_at }}</div>
                @if( $post->created_at !== $post->updated_at)
                    <div>Обновлено: {{ $post->updated_at }}</div>
                @endif
                <div>Автор: {{ $post->user->name }}</div>
            </div>

            <div>{{ Str::limit($post->description, 150) }}</div>
            <div class="read-more-link">
                <a href="{{ route('post.front.show', [$post, $post->id]) }}">Читать...</a>
            </div>


        </div>


    </div>


    {{--Read post button--}}
    <div class="read-post-button">
        <a class="btn" href="{{ route('post.front.show', [$post, $post->id]) }}">
            <img src="{{ asset('/images/arrow-right-white.svg') }}" alt="">
        </a>
    </div>

</div>
