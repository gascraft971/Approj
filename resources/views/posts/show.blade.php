@section("title", $post->title)
@extends("layouts.app")

@section("content")
<link href="{{ asset("css/posts/post.css") }}" rel="stylesheet"/>

<!-- Individual post view -->

<div class="post card">
	<div class="card-body">
		<div class="category mb-1"><span class="badge bg-danger">{{ $post->category }}</span></div>

		<!-- Post title -->
		<div class="container p-0 post-title">
			<a href="#" class="text-decoration-none me-2" style="display: inline-block">
				<h1 class="card-title">{{ $post->title }}</h1>
			</a>

			@auth
			<form method="POST" action="{{ route("posts.destroy", [$post->slug]) }}" class="d-inline-block mb-1">
				@csrf
				@method("delete")
				<div class="d-inline">
					<a href="{{ route("posts.edit", [$post->slug]) }}" class="btn btn-light btn-sm"><i class="fas fa-pencil-alt"></i></a>
					<button type="submit" class="btn btn-light btn-sm"><i class="far fa-trash-alt"></i></button>
				</div>
			</form>
			@endauth
		</div>

		<!-- Post info -->
		<div class="post-meta align-items-center text-left">
			<figure class="profile-picture d-inline me-2 mb-0">
				<img src="{{ asset("images/profile-image.jpg") }}" class="img-fluid" mr-3/>
			</figure>
			<span class="d-inline-block mt-1">By <b>John Doe</b></span> 
			<span>&middot; {{ $post->created_at->diffForHumans() }}</span>
		</div>
		<p class="card-text">
		<?php echo codex2html(json_decode($post->content, true)["blocks"]); ?>
		</p>
	</div>
</div>

@endsection