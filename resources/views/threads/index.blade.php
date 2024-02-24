<!doctype html>
<html>
	<head>
		<title>Forum</title>
		<link rel="stylesheet" href="/app.css">
	</head>
	<body>
		<h1 class="bold">Forum Threads</h1>
		
		<hr>

		@foreach($threads as $thread)
			<article>
				<h2>
					<a href="{{ $thread->path() }}">{{ $thread->title }}</a>
				</h4>
				<div class="body">{{ $thread->body }}</div>
			</article>
		@endforeach
	</body>
</html>