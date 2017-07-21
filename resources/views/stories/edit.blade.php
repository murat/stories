@extends('layouts.master')

@section('content')

  <div class="container">
    @include('stories.form', ['story' => $story])
  </div>

@endsection
