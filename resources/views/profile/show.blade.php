<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($profileUser->name) }}. Since  {{ __($profileUser->created_at->diffForHumans()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($threads as $thread)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex">
                        <h1 class="py-6">
                            {{ $thread->title }}
                        </h1>
                        <h1>
                            {{ $thread->created_at->diffForHumans() }}
                        </h1>
                    </div>
                    <p class="py-6">{{ $thread->body }}</p>
                </div>
            @endforeach
        </div>

        {{ $threads->links() }}
    </div>
</x-app-layout>
