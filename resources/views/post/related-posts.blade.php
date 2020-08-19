<div id="related-posts" class="related-posts container">
    @if( $relatedPosts->count() > 0)
        <h2>Что ещё почитать из мира геймеров и интернета</h2>
    @endif

    <div class="post-media-card">
        @php
            $related = true
        @endphp

        @forelse( $relatedPosts as $post)
            @include('includes.post-media-card', compact($related))
        @empty
        @endforelse
    </div>
</div>
