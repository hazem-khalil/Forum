<!doctype html>
<html>
	<head>
		<title>Forum</title>
		<link rel="stylesheet" href="/app.css">
	</head>
	<body>
		<h1 class="bold">{{ $thread->title }}</h1>
			
		<hr>

		<div class="body">{{ $thread->body }}</div>

		<hr>
		<div>
			<a href="/threads">Return back</a>
		</div>
	</body>
</html>