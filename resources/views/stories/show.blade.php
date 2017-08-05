@extends('layouts.master')

@section('content')
  <div class="container">
    <h3>
      <a href="{{$story->url ? $story->url : "/stories/{$story->slug}"}}" @if($story->url) target="_blank" @endif>
        {{$story->title}}
      </a>
    </h3>

    <div class="info">
      Posted {{$story->created_at->diffForHumans()}}
      @if($story->user_id)
        by <a href="/user/{{$story->user->slug}}">{{$story->user->name}}</a>
      @endif
    </div>

    <p>
      {!! nl2br($story->body) !!}
    </p>

    <div class="btn-group voting">

      <a href="#" style="pointer-events: none;" class="btn btn-default votes">{{(int)$story->upvote_count - (int)$story->downvote_count}}</a>

      @if(auth()->user())

      <?php
      $is_upVoted = \App\Vote::where('story_id', '=', $story->id)->where('user_id', '=', auth()->user()->id)->where('vote_type', '=', 'up')->exists();
      ?>
      <a href="#upvote" class="btn btn-success {{$is_upVoted ? 'disabled' : 'upvote'}}" data-story="{{$story->id}}" data-user="{{auth()->user()->id}}">
        <span class="caret" style="transform: rotate(180deg)"></span>
        upvote ({{$story->upvote_count}})
      </a>
      <?php
      $is_downVoted = \App\Vote::where('story_id', '=', $story->id)->where('user_id', '=', auth()->user()->id)->where('vote_type', '=', 'down')->exists();
      ?>
      <a href="#downvote" class="btn btn-danger {{$is_downVoted ? 'disabled' : 'downvote'}}" data-story="{{$story->id}}" data-user="{{auth()->user()->id}}">
        <span class="caret"></span>
        downvote ({{$story->downvote_count}})
      </a>

      @else

        <a href="/login" class="btn btn-default">Sign in for voting</a>

      @endif

    </div>

    <hr />

    <h3 id="comments">Comment/s ({{$story->comments->count()}})</h3>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <div class="row" id="new-comment">
      <div class="col-md-12 comments">
        <div class="comment-wrap">
          <div class="comment-block">

            <form action="/stories/{{$story->slug}}/comments" method="post" class="form-horizontal">
              {{csrf_field()}}
              <input type="hidden" name="story_id" value="{{$story->id}}">

              @if(!auth()->user())
                <div class="form-group">
                  <input type="text" name="email" placeholder="E mail" />
                </div>
              @else
                <input type="hidden" name="email" value="{{auth()->user()->email}}" />
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
              @endif
              <div class="form-group">
                <textarea name="comment" placeholder="Comment..."></textarea>
              </div>
              <div class="bottom-comment">
                <ul class="comment-actions">
                  <button class="pull-right btn btn-link" type="submit">
                    Save
                  </button>
                </ul>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="comments col-md-12">
        @each('comments.comment', $story->comments()->whereRaw('reply_id is null')->get(), 'comment')

        {{-- @foreach($story->comments()->whereRaw('reply_id is null')->get() as $comment)
          @render('')
        @endforeach --}}
      </div>
    </div>

  </div>
@endsection
