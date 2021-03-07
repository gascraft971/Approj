@section("title", "New Post")
@extends("layouts.app")

@section("content")
<link href="{{ asset("css/posts/create.css") }}" rel="stylesheet"/>
<h1>Create a new post</h1>

<form method="POST" action="{{ route("posts.store") }}">
	@csrf
	@include("partials.errors")

	<input type="hidden" name="image" value="https://via.placeholder.com/750x450"/>

	<div class="form-floating">
		<input type="text" id="title-input" name="title" value="{{ old("title") }}" class="form-control" minlength="5" maxlength="100" required="required"/>
		<label class="form-label" for="title-input">Title</label>
	</div>

	<br/>

	<!--<div class="form-floating">
		<textarea type="text" id="content-input" name="content" class="form-control" minlength="5" maxlength="5000" required="required" rows="10">{{ old("content") }}</textarea>
		<label class="form-label" for="content-input">Content</label>
	</div>-->
	<input type="hidden" name="content" value='{"time":"{{ time() }}","blocks":[],"version":"2.19.1"}'>

	<br/>

	<div>
		<label class="form-label" for="category-input">Category</label>
		<select name="category" id="category-input" required>
			<option value="" disabled selected>Select category</option>
			<option value="HTML" {{ old('category') === 'HTML' ? 'selected' : null }}>HTML</option>
			<option value="CSS" {{ old('category') === 'CSS' ? 'selected' : null }}>CSS</option>
			<option value="JavaScript" {{ old('category') === 'JavaScript' ? 'selected' : null }}>JavaScript</option>
			<option value="PHP" {{ old('category') === 'PHP' ? 'selected' : null }}>PHP</option>
		</select>
	</div>

	<div class="field">
		<div class="control">
			<button type="submit" class="btn btn-outline-primary">Publish</button>
		</div>
	</div>
</form>
@endsection