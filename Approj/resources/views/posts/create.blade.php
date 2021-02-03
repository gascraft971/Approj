@section("title", "New Post")
@extends("layout")

@section("content")
<h1>Create a new post</h1>

<form method="POST" action="{{ route("posts.store") }}">
	@csrf
	

	<div class="form-outline">
		<input type="text" id="title-input" name="title" value="{{ old("title") }}" class="form-control" minlength="5" maxlength="100" required="required"/>
		<label class="form-label" for="title-input">Title</label>
	</div>

	<br/>

	<div class="form-outline">
		<textarea type="text" id="content-input" name="content" class="form-control" minlength="5" maxlength="2000" required="required" rows="10">{{ old("content") }}</textarea>
		<label class="form-label" for="content-input">Content</label>
	</div>

	<br/>

	<div>
		<label class="form-label" for="category-input">Category</label>
		<select name="category" id="category-input" required>
			<option value="" disabled selected>Select category</option>
			<option value="html" {{ old('category') === 'html' ? 'selected' : null }}>HTML</option>
			<option value="css" {{ old('category') === 'css' ? 'selected' : null }}>CSS</option>
			<option value="javascript" {{ old('category') === 'javascript' ? 'selected' : null }}>JavaScript</option>
			<option value="php" {{ old('category') === 'php' ? 'selected' : null }}>PHP</option>
		</select>
	</div>
</form>
@endsection