@section("title", "Home")
@extends("layouts.app")

@section("content")
<link href="{{ asset("css/posts/index.css") }}" rel="stylesheet"/>
@include("partials.errors")

<div class="posts">
@foreach ($posts as $post)
	@include("partials.summary", ["truncate" => true])
@endforeach
</div>

@endsection