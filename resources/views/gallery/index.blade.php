<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield("title") &middot; Approj</title>

	<!-- Bootstrap icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
	<!-- MDB 5 -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
	
	<!-- Main app CSS, shared by all views -->
	<link href="{{ asset("css/main.css") }}" rel="stylesheet"/>
	<!-- App CSS -->
	<link href="{{ asset("css/gallery/index.css") }}" rel="stylesheet"/>
</head>
<body>
	<button class="gallery-trigger">Open gallery</button>
	@yield("gallery")
	<!-- jQuery 3.5.1 -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- MDB 5 -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
	<!-- App scripts -->
	<script type="text/javascript" src="{{ asset("js/gallery/main.js") }}"></script>
	<script src="{{ asset("js/main.js") }}"></script>
	<!-- Image uploader -->
	<script src="{{ asset("js/libs/simple-uploader.min.js") }}"></script>
</body>
</html>