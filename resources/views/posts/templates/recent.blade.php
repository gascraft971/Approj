<div class="recent-post card ">
	@if ($post->published)
	<a href="{{ route("posts.show", [$post->slug]) }}" class="text-decoration-none">
	@else
	<a href="/post/{{$post->uuid}}/edit" class="text-decoration-none">
	@endif
		<div class="post-image">
			<img src="{{ $post->image }}" class="card-img-top"/>
		</div>
		<div class="card-body">
			<div class="post-meta mb-1">
				<span class="badge bg-danger">{{ $post->category }}</span>
				<span class="date-created ms-2">{{ $post->created_at->toFormattedDateString() }}</span>
			</div>
			<h3 class="card-title d-inline">{{ $post->title }}</h3>
			@if (!$post->published)
				<span class="badge bg-warning"><i class="bi bi-pen"></i> Unpublished</span>
			@endif
		</div>
	</a>
</div>