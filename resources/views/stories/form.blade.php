
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
  <form action="/stories{{isset($story)?"/{$story->id}":''}}" method="post" class="form-horizontal">
    {{csrf_field()}}
    <div class="form-group">
      <label for="title" class="control-label">Title</label>
      <input type="text" name="title" id="title" class="form-control" value="{{isset($story)?$story->title:''}}" required />
    </div>
    <div class="form-group">
      <label for="body" class="control-label">Body</label>
      <textarea name="body" id="body" class="form-control">{{isset($story)?$story->body:''}}</textarea>
    </div>
    <div class="form-group">
      <label for="url" class="control-label">Url</label>
      <input type="text" name="url" id="url" class="form-control" value="{{isset($story)?$story->url:''}}" />
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success pull-right">Save</button>
    </div>
  </form>
</div>
