<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold">
						<a href="#">{{ $thread->creator->name }}</a>	
						{{ $thread->title }}
					</h1> posted:

					<div class="p-15">{{ $thread->body }}</div>

					<hr>
					<h1 class="font-bold">Replies</h1>
					<div>
						@foreach($thread->replies as $reply)
							<article class="p-14">
								<h2 class="font-semibold">
									<a href="#">{{ $reply->owner->name }}</a>
								</h2> said: 
									{{ $reply->created_at->diffForHumans() }}

								<div class="body">{{ $reply->body }}</div>
							</article>
						@endforeach
					</div>

					<div>
						<a href="/threads">Return back</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>