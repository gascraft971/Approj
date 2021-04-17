@section("title", "Edit Post")
@section("action", route("posts.create"))
@extends("layouts.editor")
@section("content")

<header id="navbar">
    <div class="navbar fixed-top navbar-light bg-light p-2 pb-1" style="justify-content: normal">
		<img src="{{ asset("images/logo/icon.png") }}" height="50" class="p-1 ms-2"/>
		<div class="menu ms-3 me-auto">
			<input type="text" id="post-title-input" class="form-control" value="{{ $post->title }}"/>
			<div class="menu-buttons">
				<div class="menu-dropdown dropdown">
					<button class="dropdown-btn btn btn-light dropdown-toggle" data-mdb-toggle="dropdown" aria-expande="false">File</button>
					<ul class="dropdown-menu bg-light shadow-sm">
						<li><a class="dropdown-item" href="{{ route("posts.index") }}">Home</a></li>
						<li><hr class="dropdown-divider m-0"/></li>
						<li><a class="dropdown-item" href="{{ route("posts.create") }}">New</a></li>
						<li><a class="dropdown-item disabled" href="#">Open</a></li>
						<li><hr class="dropdown-divider m-0"/></li>
						<li><a class="dropdown-item disabled" href="#">Share</a></li>
					</ul>
				</div>

				<div class="menu-dropdown dropdown">
					<button class="dropdown-btn btn btn-light dropdown-toggle" data-mdb-toggle="dropdown" aria-expande="false">Edit</button>
					<ul class="dropdown-menu bg-light shadow-sm">
						<li><a class="dropdown-item disabled" href="#">Undo</a></li>
						<li><a class="dropdown-item disabled" href="#">Redo</a></li>
					</ul>
				</div>
			</div>
		</div>
		<button class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#previewModal">PREVIEW</button>
    </div>
</header>

<div id="loader" class="p-5">
	<div class="loader">
		<div>
			<svg class="text-primary" aria-label="Chargement..." width="68.75" height="100" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
				<g transform="matrix(1 0 0 -1 0 80)">
					<rect width="10" height="20" rx="3">
						<animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"/>
					</rect>
					<rect x="15" width="10" height="80" rx="3">
						<animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"/>
					</rect>
					<rect x="30" width="10" height="50" rx="3">
						<animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"/>
					</rect>
					<rect x="45" width="10" height="30" rx="3">
						<animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"/>
					</rect>
				</g>
			</svg>
			<p>{{ $post->title }}</p>
		</div>
	</div>
</div>

<!-- TODO: Fix this annoying thing -->
<div id="post-data" class="d-none">
	<div id="post-content">
		{{ $post->content }}
	</div>
</div>

<div id="editorjs-container" class="container shadow">
	<br/>
	<br/>
	<div id="editorjs" class="d-none" data-post-route="/post/{{ $post->uuid }}"></div>
</div>

<div id="toolbar" class="shadow-lg d-flex">
	<div class="btn-group">
		<button class="btn btn-light" data-toggle="tooltip" title="Annuler">
		<i class="bi-arrow-return-left"></i>
	</button>
		<button class="btn btn-light" data-toggle="tooltip" title="Revenir" disabled="disabled">
			<i class="bi-arrow-return-right"></i>
		</button>
	</div>
	<button class="btn btn-light save-btn" data-toggle="tooltip" title="Sauvegarde..." disabled="disabled">
		<i class="bi-cloud-check"></i>
		<span class="ml-1"></span>
	</button>
</div>

<div id="modals">
	<!-- Page preview modal -->
	<div class="modal top fade" id="previewModal" tabindex="-1" aria-labelledby="Page preview modal" aria-hidden="true">
	    <div class="modal-dialog modal-xl  modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-0">
	                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
	                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
					<iframe src="/posts/{{ $post->slug }}/preview"></iframe>
				</div>
	        </div>
	    </div>
	</div>
</div>
@endsection