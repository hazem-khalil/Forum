<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold mb-4">
						<a href="#">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}
					</h1> 

					<div class="p-15 mb-4">{{ $thread->body }}</div>

					<hr>
					<h1 class="font-semibold mt-5 mb-4">Replies</h1>
					<div>
						@foreach($thread->replies as $reply)
							<article class="py-12">
								<div>
									<h2 class="font-semibold">
										<a href="#">{{ $reply->owner->name }}</a>
									</h2> 
									<div class="mt-3 mb-3"> <b>said:</b> {{ $reply->body }}</div>
									<div>{{ $reply->created_at->diffForHumans() }}</div>
									</div>

								<div class="font-semibold space-x-8">
									<form method="POST" action="/replies/{{ $reply->id }}/favorites">
										@csrf
										<button type="submit" {{ $reply->isFavorited()  ? 'disabled' : ''}}>
											{{ $reply->favorites()->count() }} Favorite
										</button>
									</form>
								</div>

								<hr>
							</article>
						@endforeach
					</div>
					@if(auth()->check())
						<form method="POST" action="{{ $thread->path() . '/replies' }}">
	                        @csrf

	                        <div>
	                            <x-input-label for="body" :value="__('Body')"/>
	                            <x-text-input id="body" class="block mt-1 w-full" type="text" name="body"/>
	                        </div>

	                        <x-primary-button class="ms-3 mt-3">
	                            {{ __('Submit') }}
	                        </x-primary-button>
	                    </form>
					@else
						<p>Please <a href="/login">signIn</a> to participate on threads.</p>
					@endif

					<div>
						<a href="/threads">Return back</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>