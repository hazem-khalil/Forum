<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Threads') }}
        </h2>
        <div>
            <a href="/threads/create">New Thread</a>
        </div>

        <label for="channels">Choose Channel:</label>

        <select name="channels" id="channels">
            <!-- channels variable comes from AppServiceProvider from boot() -->
            @foreach($channels as $channel)
              
              <a href="/threads/{{$channel->slug }}">
                  <option value="<a>">{{$channel->name}}</option>
              </a>
          @endforeach
        </select>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach($threads as $thread)
						<article class="p-14">
							<h2 class="font-semibold">
								<a href="{{ $thread->path() }}">{{ $thread->title }}</a>
							</h2>
							<div>{{ $thread->body }}</div>
						</article>
						<hr>
					@endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>