<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield("title") - Approj</title>

	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<!-- Main app CSS code, shared by all views -->
	<link href="{{ asset("css/main.css") }}" rel="stylesheet"/>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-sm navbar-light bg-light">
		<!-- Container wrapper -->
		<div class="container-fluid">
		<!-- Navbar brand -->
		<a class="navbar-brand" href="#">Approj</a>
	
		<!-- Toggle button -->
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fas fa-bars"></i>
		</button>
	
		<!-- Collapsible wrapper -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Links -->
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="{{ route("posts.index") }}">All posts</a>
				</li>
			</ul>
			<a href="{{ route("posts.create") }}">
				<button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Post</button>
			</a>
		</div>
		<!-- Collapsible wrapper -->
		</div>
		<!-- Container wrapper -->
	</nav>
	<!-- Navbar -->

	<main>
		<div class="container">
			@if (session("notification"))
			<div class="note note-primary">
				{{ session("notification") }}
			</div>
			@endif

			@yield("content")
		</div>
	</main>

	<footer class="bg-light text-center text-lg-start">
		<!-- Copyright -->
		<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
			© {{ date("Y") }} Copyright:
			<a class="text-dark" href="#">Approj</a>
		</div>
		<!-- Copyright -->
	</footer>
	
	<!-- Bootstrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>