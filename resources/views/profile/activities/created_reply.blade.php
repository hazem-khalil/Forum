<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
	<div class="py-6">
		<div class="py-3 ">
			<span class="font-semibold">{{ $profileUser->name }}</span> replies to 
			<a class="font-semibold" href="{{ $activity->subject->thread->path() }}">
				{{ $activity->subject->thread->title }}
			</a>
		</div>
		<hr>
		<div class="py-3">
			{{ $activity->subject->body }}
		</div>
	</div>
</div>