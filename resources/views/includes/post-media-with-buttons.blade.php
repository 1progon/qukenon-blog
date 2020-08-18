<div class="media with-buttons">

    <h1 class="subtitle">{{ $post->title }}</h1>


    <div class="content-block">
        <div class="content">
            <div class="thumbnail">

                @php
                    /** @var \App\Models\Post\Post $post */
                    $firstImage = $post->images()->first()
                @endphp

                @if( isset( $firstImage))
                    @php
                        $thumb = \App\Http\Controllers\Post\PostsController::THUMB['small'];
                        /** @var \App\Models\Post\PostImage $firstImage */
                        $imagePathThumb = $firstImage->folder . '/' . $thumb['str'] . '_' . $firstImage->filename
                    @endphp


                    <a data-fancybox="gallery"
                       href="{{ asset('storage/' . $firstImage->folder . '/' . $firstImage->filename) }}">

                        <img src="{{ asset('storage/' . $imagePathThumb )}}"
                             alt=""
                             width="{{ $thumb['w'] }}"
                             height="{{ $thumb['h'] }}">

                        <span class="image-overlay"></span>
                        <span class="enlarge-image">
                            <img src="{{ asset('/images/search-pink.svg') }}"
                                 alt="image overlay">
                        </span>
                    </a>

                @else
                    <img src="{{ asset('images/default-image.jpg') }}" alt="default image">
                @endif


            </div>


            {{--Post description--}}
            <div class="description">

                {{--Meta--}}
                <div class="meta">
                    <div>Опубликовано: {{ $post->created_at }}</div>
                    @if( $post->created_at != $post->updated_at)
                        <div>Обновлено: {{ $post->updated_at }}</div>
                    @endif
                    {{--                    <div>Автор: {{ $post->user->name }}</div>--}}
                </div>


                {{--Description text--}}
                <div>{{ $post->description }}</div>

                {{--Buttons--}}
                <div class="special-buttons">
                    @forelse( $post->files as $file )

                        <a class="btn" download href="{{ asset('storage/' . $file->folder . '/' . $file->name ) }}">
                            Скачать скин
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>


    </div>
</div>
