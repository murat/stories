@extends('layouts.master')

@section('content')
  <div class="container">
    @if($user)
      <h3>{{$user->name}}'s stories</h3>
    @endif
    <ul class="list-group">
      @foreach($stories as $story)
        <li class="list-group-item">
          <a href="/stories/{{$story->slug}}">{{$story->title}}</a>

          <span class="pull-right">
            <span class="label label-success">
              <?php $vote = (int)$story->upvote_count - (int)$story->downvote_count; ?>
              {{$vote}} {{ $vote > 1 ? 'votes' : 'vote' }} )
            </span>
            &nbsp;
            <span class="label label-primary">
              <a href="/stories/{{$story->slug}}#comments" style="color: #fff">({{count($story->comments)}} {{ count($story->comments) > 1 ? 'comments' : 'comment' }} )</a>
            </span>
            &nbsp;
            <span class="label label-info">Created {{$story->created_at->diffForHumans()}}</span>
          </span>
        </li>
      @endforeach
    </ul>
  </div>
@endsection
