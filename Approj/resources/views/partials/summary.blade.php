<div class="post card">
	<div class="card-body">

		<!-- Post title -->
		<div class="container p-0">
			<a href="{{ route("posts.show", [$post->slug]) }}"" class="text-decoration-none" style="display: inline-block">
				<h2 class="card-title">{{ $post->title }}</h2>
			</a>

			@auth
			<form method="POST" action="{{ route("posts.destroy", [$post->slug]) }}" class="d-inline">
				@csrf
				@method("delete")
				<div class="d-inline">
					<a href="{{ route("posts.edit", [$post->slug]) }}" class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></a>
					<button type="submit" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
				</div>
			</form>
			@endauth
		</div>

		<!-- Post info -->
		<div class="fw-lighter">
			{{ $post->created_at->diffForHumans() }} &middot; {{ $post->category }}
		</div>
		<p class="card-text">
		<?php
		$content = nl2br(e($post->content));
		if (isset($truncate))  {
			if (strlen($content) > 200) {
				$content = substr($content, 0, 400) . "...";
			}
		}
		echo $content
		?>
		</p>
		
		@auth
		<form method="POST" action="{{ route("posts.destroy", [$post->slug]) }}">
			@csrf
			@method("delete")
			<div>
				<a href="{{ route("posts.edit", [$post->slug]) }}" class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></a>
				<button type="submit" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
			</div>
		</form>
		@endauth
	</div>
</div>