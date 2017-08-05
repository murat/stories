<div class="comment-wrap {{$comment->reply_id ? 'reply' : ''}}" id="{{$comment->id}}">
  <div class="photo">
    <div class="avatar" style="background-image: url('https://www.gravatar.com/avatar/{{md5($comment->email)}}?d=identicon')"></div>
  </div>
  <div class="comment-block">
    <p class="comment-text">
      {!! nl2br($comment->comment) !!}
    </p>
    <div class="bottom-comment">
      <div class="comment-date">Created {{$comment->created_at->diffForHumans()}} @if($comment->user_id) by <a href="/user/{{$comment->user->slug}}">{{$comment->user->name}}</a> @endif</div>
      <ul class="comment-actions">
        <li class="reply"><a href="#comments" class="reply" data-reply-id="{{$comment->id}}">Reply</a></li>
      </ul>
    </div>
  </div>
</div>

@if($comment->replies->count())
  @each('comments.comment', $comment->replies, 'comment')
@endif
