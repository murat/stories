@extends('layouts.master')

@section('content')
  <div class="container">
    <ul class="list-group">
      @foreach($stories as $story)
        <li class="list-group-item">
          <a href="/stories/{{$story->slug}}">{{$story->title}}</a>

          <span class="pull-right">
            <span class="label label-info">
              ({{count($story->comments)}} {{ count($story->comments) > 1 ? 'comments' : 'comment' }} )
            </span>
            &nbsp;
            <span class="label label-info">Created {{$story->created_at->diffForHumans()}}</span>
          </span>
        </li>
      @endforeach
    </ul>
  </div>
@endsection
