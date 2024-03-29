<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($profileUser->name) }}. Since  {{ __($profileUser->created_at->diffForHumans()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($activities as $data => $activity)
                <h1 class="py-3">{{ $data }}</h1>
                    @foreach ($activity as $record)
                        @if(view()->exists("profile.activities.{$record->type}"))
                            @include ("profile.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach
                <hr>    
            @endforeach
        </div>

        
    </div>
</x-app-layout>
