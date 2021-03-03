<div class="post card">
	<div class="card-body">
		<a href="{{ route("posts.show", [$post->slug]) }}"" class="text-decoration-none">
			<h2 class="card-title">{{ $post->title }}</h2>
		</a>
		<p class="card-subtitle"><b>Posted:</b> {{ $post->created_at->diffForHumans() }}</p>
		<p class="card-subtitle"><b>Category:</b> {{ $post->category }}</p>
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

		<form method="POST" action="{{ route("posts.destroy", [$post->slug]) }}">
			@csrf
			@method("delete")
			<div>
					<a href="{{ route("posts.edit", [$post->slug]) }}" class="btn btn-outline-info">Edit</a>
					<button type="submit" class="btn btn-outline-danger">Delete</button>
			</div>
		</form>
	</div>
</div>