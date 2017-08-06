@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="col-md-12">
    <form action="/stories{{isset($story)?"/{$story->id}":''}}" method="post" class="form-horizontal">
        {{csrf_field()}}
        <div class="form-group">
            <label for="title" class="control-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{isset($story)?$story->title:''}}" required />
        </div>
        <div class="form-group">
            <label for="body" class="control-label">Body</label>
            <div name="body" id="body" class="editor form-control">{{isset($story)?$story->body:''}}</div>
        </div>
        <div class="form-group">
            <label for="url" class="control-label">Url</label>
            <input type="text" name="url" id="url" class="form-control" value="{{isset($story)?$story->url:''}}" />
        </div>
        <div class="form-group">
            @if(auth()->user())
                <span class="checkbox-inline">
                    <input type="checkbox" name="user_id" value="0" id="anonym" />
                    <label for="anonym">Post anonymously</label>
                </span>
            @endif
            <button type="submit" class="btn btn-success pull-right">Save</button>
        </div>
    </form>
</div>
