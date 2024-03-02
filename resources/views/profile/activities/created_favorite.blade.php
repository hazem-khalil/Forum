@if($activity->subject->favorited)
	<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
		<div class="py-6">
			<div class="py-3 ">
				<span class="font-semibold">{{ $profileUser->name }}</span> favorited a 
				<a class="font-semibold" href="{{ $activity->subject->favorited->path() }}">reply</a>.
			</div>
			<hr>
			<div class="py-3">
				{{ $activity->subject->favorited->body }}
			</div>
		</div>
	</div>
@endif