<div class="featured-post card shadow-lg">
	<a href="{{ route("posts.show", [$post->slug]) }}" class="text-decoration-none">
		<img src="{{ $post->image }}" class="card-img-top"/>
		<div class="card-body">
			<div class="post-meta mb-1">
				<span class="badge bg-danger">{{ $post->category }}</span>
				<span class="date-created ms-2">{{ $post->created_at->toFormattedDateString() }}</span>
			</div>
			<h3 class="card-title">{{ $post->title }}</h3>
			<!--
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
			-->
		</div>
	</a>
</div>