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
		<h1>Replies</h1>
		<div>
			@foreach($thread->replies as $reply)
				<article>
					<a href="#">{{ $reply->owner->name }}</a> said: 
						{{ $reply->created_at->diffForHumans() }}

					<div class="body">{{ $reply->body }}</div>
				</article>
			@endforeach
		</div>

		<div>
			<a href="/threads">Return back</a>
		</div>
	</body>
</html>