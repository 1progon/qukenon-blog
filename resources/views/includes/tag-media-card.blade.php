<div class="media">

    <a href="{{ route('tags.front.show', [$tag]) }}">
        @if( isset($related))
            <h4 class="title">{{ $tag->name }}</h4>
        @else
            <h1 class="subtitle">{{ $tag->name }}</h1>
        @endif
    </a>


    <div class="content">

        <div class="thumbnail">


            <a href="{{ route('tags.front.show', [$tag]) }}">
                @php
                    $image = $tag->image;
                    $thumb = \App\Http\Controllers\Post\PostsController::THUMB['small']
                @endphp

                @if( isset( $image))

                    <img src="{{ asset('storage/' . $image )}}"
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
                <div>Опубликовано: {{ $tag->created_at }}</div>
                @if( $tag->created_at != $tag->updated_at)
                    <div>Обновлено: {{ $tag->updated_at }}</div>
                @endif
            </div>

            <div>{{ Str::limit($tag->description, 150) }}</div>
            <div class="read-more-link">
                <a href="{{ route('tags.front.show', [$tag]) }}">Перейти...</a>
            </div>
        </div>

    </div>


    {{--Read post button--}}
    <div class="read-post-button">
        <a class="btn" href="{{ route('tags.front.show', [$tag]) }}">
            <img src="{{ asset('/images/arrow-right-white.svg') }}" alt="">
        </a>
    </div>

</div>
