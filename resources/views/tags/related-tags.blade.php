<div id="related-posts" class="related-posts container">
    @if( $relatedTags->count() > 0)
        <h2>Смотреть ещё</h2>
    @endif

    <div class="post-media-card">
        @php
            $related = true
        @endphp

        @forelse( $relatedTags as $tag)
            @include('includes.tag-media-card', compact($related))
        @empty
        @endforelse
    </div>
</div>
