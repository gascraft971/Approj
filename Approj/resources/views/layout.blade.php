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
	<!-- MDB -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.css" rel="stylesheet"/>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<!-- Container wrapper -->
		<div class="container-fluid">
		<!-- Navbar brand -->
		<a class="navbar-brand" href="#">Approj</a>
	
		<!-- Toggle button -->
		<button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fas fa-bars"></i>
		</button>
	
		<!-- Collapsible wrapper -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Links -->
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="{{ route("posts.index") }}">All posts</a>
				</li>
				<li class="nav-item">
					<a class="nav-link float-right" href="{{ route("posts.create") }}">
						<button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Post</button>
					</a>
				</li>
			</ul>
		</div>
		<!-- Collapsible wrapper -->
		</div>
		<!-- Container wrapper -->
	</nav>
	<!-- Navbar -->

	<section class="section">
		<div class="container">
			@if (session("notification"))
			<div class="notification">
				{{ session("notification") }}
			</div>
			@endif

			@yield("content")
		</div>
	</section>

	<footer class="bg-light text-center text-lg-start">
		<!-- Copyright -->
		<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
			© {{ date("Y") }} Copyright:
			<a class="text-dark" href="#">Approj</a>
		</div>
		<!-- Copyright -->
	</footer>
	
	<!-- MDB -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"></script>
</body>
</html>