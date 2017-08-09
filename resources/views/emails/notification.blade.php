@extends('mailtemplate::emails.default')

@section('logo')
    <img alt="" src="https://www.eyerys.com/sites/default/files/notify-app-logo.jpg" style="display: block;height: auto;width: 100%;border: 0;max-width: 142px;max-height: 142px;" width="142">
@endsection

@section('header')
    You have a new notification!
@endsection

@section('content')
    <p class="paragraph">Hi, You have a comment upon the {{$story->title}} titled story.</p>

    <p class="paragraph">
        {{$comment->comment}}
    </p>
@endsection
