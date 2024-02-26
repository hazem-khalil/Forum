<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Threads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-4">Create Thread</h1>
                    <hr>
                    <form method="POST" action="/threads">
                        @csrf
                        <div>
                            <x-input-label for="channel_id" :value="__('Choose a Channel')"/>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">Choose One</option>
                                <!-- channels comes from boot method from AppServicesProvider -->
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }} >
                                        {{ $channel->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title') }}" required/>
                        </div>

                        <div>
                            <x-input-label for="body" :value="__('Body')"/>
                            <x-text-input id="body" class="block mt-1 w-full" type="text" name="body" value="{{ old('body') }}" required/>
                        </div>

                        <x-primary-button class="ms-3 mt-3">
                            {{ __('Publish') }}
                        </x-primary-button>
                    </form>

                    @if(count($errors))
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>