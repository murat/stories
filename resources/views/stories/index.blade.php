@extends('layouts.master')

@section('content')
<div class="container">
    @if($user && $votes)
        <h3>Stories voted by {{$user->name}}</h3>
    @elseif($user && !$votes)
        <h3>{{$user->name}}'s stories</h3>
    @else
        <h3>Latest stories</h3>
    @endif

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
@endsection
