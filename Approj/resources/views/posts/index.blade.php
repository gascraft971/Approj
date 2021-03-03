@section("title", "Home")
@extends("layout")

@section("content")
<link href="{{ asset("css/posts/index.css") }}" rel="stylesheet"/>

<div class="posts">
@foreach ($posts as $post)
	@include("partials.summary", ["truncate" => true])
@endforeach
</div>

@endsection