@extends('layouts.master')

@section('content')
  <div class="container">
    <h3>{{$story->title}}</h3>

    <div class="info">
      Posted {{$story->created_at->diffForHumans()}}
      @if($story->user_id)
        by <a href="/user/{{$story->user->slug}}">{{$story->user->name}}</a>
      @endif
    </div>

    <p>
      {!! nl2br($story->body) !!}
    </p>

    <hr />
    <h5 style="font-weight: bold;">New comment :</h5>

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

            <form action="/stories/{{$story->slug}}/comments" method="post" class="ajax-form form-horizontal">
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
        @foreach($story->comments as $comment)
          <div class="comment-wrap">
            <div class="photo">
              <div class="avatar" style="background-image: url('http://s.gravatar.com/avatar/{{md5($comment->email)}}')"></div>
            </div>
            <div class="comment-block">
              <p class="comment-text">
                {!! nl2br($comment->comment) !!}
              </p>
              <div class="bottom-comment">
                <div class="comment-date">{{$comment->created_at->diffForHumans()}}</div>
                <ul class="comment-actions">
                  <li class="reply"><a href="#new-comment" data-reply-id="{{$comment->id}}">Reply</a></li>
                </ul>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

  </div>
@endsection
