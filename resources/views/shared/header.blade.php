<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Stories</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">/home</a></li>
        <li><a href="/help">/help</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/stories/create">/new story</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            @if(auth()->user())
              /{{str_slug(auth()->user()->name)}} <span class="caret"></span>
            @else
              /user <span class="caret"></span>
            @endif
          </a>
          <ul class="dropdown-menu">
            @if(auth()->user())
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/logout">/logout</a></li>
            @else
              <li><a href="/login">/login</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>