@extends('layouts.master')

@section('content')
<div class="container-fuild margin-up-nav">
    @if($user && $votes)
        <h3>Stories voted by {{$user->name}}</h3>
    @elseif($user && !$votes)
        <h3>{{$user->name}}'s stories</h3>
    @endif

    <div class="col-md-9">
        <ul class="list-group">
            @foreach($stories as $story)
                <li class="list-group-item">
                    <a href="/stories/{{$story->slug}}">{{$story->title}}</a>

                    <span class="pull-right">
                    <?php $vote = (int)$story->upvote_count - (int)$story->downvote_count; ?>
                        <span class="label label-{{$vote > 0 ? 'success' : 'danger'}}">
                        {{$vote}} {{ $vote > 1 ? 'votes' : 'vote' }}
                    </span>
                    &nbsp;
                        @if(count($story->comments))
                            <span class="label label-primary">
                            <a href="/stories/{{$story->slug}}#comments" style="color: #fff">({{count($story->comments)}} {{ count($story->comments) > 1 ? 'comments' : 'comment' }} )</a>
                        </span>
                        @endif
                        &nbsp;
                    <span class="label label-info">Created {{$story->created_at->diffForHumans()}}</span>
                </span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-3">
        <ul class="right-side">
            @if(auth()->user())
            <li class="right-side-item"><a href="/stories/create"><i class="fa fa-plus-square-o"></i> New Story</a></li>
            <li class="right-side-item"><a href="/user/{{auth()->user()->slug}}"><i class="fa fa-address-book-o"></i> My Stories</a></li>
            <li class="right-side-item"><a href="/user/{{auth()->user()->slug}}/votes"><i class="fa fa-thumbs-o-up"></i>My Votes</a></li>
            <li class="right-side-item"><a href="/logout"><i class="fa fa-power-off"></i>Logout</a></li>
            @else
            <li class="right-side-item"><a href="/stories/create"><i class="fa fa-plus-square-o"></i> New Story</a></li>
            <li class="right-side-item"><a href="/login"><i class="fa fa-sign-in"></i>login</a></li>
            @endif
        </ul>
    </div>
</div>
@endsection
