@section("title", "Home")
@extends("layouts.app")

@section("content")
<link href="{{ asset("css/posts/index.css") }}" rel="stylesheet"/>
@include("partials.errors")

<br/>
<br/>
<br/>
<section id="featured">
	<div class="wrapper mx-auto">
		<div class="row">
		@foreach ($posts->slice(1, 2) as $post)
			<div class="col-sm-6">@include("posts.templates.featured")</div>
		@endforeach
		</div>
	</div>
</section>
<br/>
<section id="recent">
	<div class="wrapper mx-auto">
		<h1>Recent posts</h1>
		<br/>
		@foreach ($posts->chunk(3) as $chunk)
		<div class="row mb-3">
			@foreach ($chunk as $post)
				<div class="col-sm-4">@include("posts.templates.recent")</div>
			@endforeach
		</div>
		@endforeach
	</div>
</section>

@endsection