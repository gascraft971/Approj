@section("title", "Edit Post")
@section("action", route("posts.create"))
@extends("layouts.app")
@section("content")
<link href="{{ asset("css/posts/create.css") }}" rel="stylesheet"/>
<h1>Edit: {{ $post->title }}</h1>

<form method="POST" action="{{ route("posts.update", [$post->slug]) }}">
	@csrf
	@method("patch")
	@include("partials.errors")

	<div class="form-floating">
		<input type="text" id="title-input" name="title" value="{{ $post->title }}" class="form-control" minlength="5" maxlength="100" required="required"/>
		<label class="form-label" for="title-input">Title</label>
	</div>

	<br/>

	<div class="form-floating">
		<textarea type="text" id="content-input" name="content" class="form-control" minlength="5" maxlength="5000" required="required">{{ $post->content }}</textarea>
		<label class="form-label" for="content-input">Content</label>
	</div>

	<br/>

	<div>
		<label class="form-label" for="category-input">Category</label>
		<select name="category" id="category-input" required>
			<option value="" disabled selected>Select category</option>
			<option value="HTML" {{ $post->category === 'HTML' ? 'selected' : null }}>HTML</option>
			<option value="CSS" {{ $post->category === 'CSS' ? 'selected' : null }}>CSS</option>
			<option value="JavaScript" {{ $post->category === 'JavaScript' ? 'selected' : null }}>JavaScript</option>
			<option value="PHP" {{ $post->category === 'PHP' ? 'selected' : null }}>PHP</option>
		</select>
	</div>

	<div class="field">
		<div class="control">
			<button type="submit" class="btn btn-outline-primary">Update</button>
		</div>
	</div>
</form>
@endsection