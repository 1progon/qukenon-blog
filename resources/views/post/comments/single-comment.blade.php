@forelse( $comments as $comment)
    <div class="comment-single">
        {{ $comment->created_at }}
        {{ $comment->title }}
        {{ $comment->text }}
    </div>
@empty
@endforelse
