@extends('layouts.master')

@section('content')
  <div class="container">
    <h3>{{$story->title}}</h3>

    <div class="info">
      {{--{{'@author :'}} {{$story->}}--}}
      {{$story->created_at->diffForHumans()}}
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

    <div class="col-md-12">
      <form action="/stories/{{$story->slug}}/comments" method="post" class="ajax-form form-horizontal">
        {{csrf_field()}}
        <input type="hidden" name="story_id" value="{{$story->id}}">
        <input type="hidden" name="email" value="sdfsdf@gmail.com">

        <div class="form-group">
          <textarea class="form-control" name="comment"></textarea>
        </div>
        <div class="form-group">
          <button class="pull-right btn btn-success" type="submit">
            Save
          </button>
        </div>
      </form>
    </div>

    <ul class="list-unstyled">
      @foreach($story->comments() as $comment)
        <li>
          {{$story->comment}}
        </li>
      @endforeach
    </ul>
  </div>
@endsection
