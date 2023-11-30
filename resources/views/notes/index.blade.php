<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if( request()->routeIs('notes.index') )
                {{ __('Notes') }}
            @else
                {{ __('Trashed') }}
            @endif
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("All Notes") }}
                </div>
            </div>
        </div>
    </div> -->


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert></x-alert>
            @if( request()->routeIs('notes.index') )
                <a class="btn btn-link mb-3" href="{{ route('notes.create') }}">Add New Note</a>
            @endif
            @forelse($notes as $note)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg mt-4 mb-4">
                @if( request()->routeIs('notes.index') )

                <a class="font-bold text-2xl" href="{{ route('notes.show', $note) }}">
                        {{$note->title}}
                    </a>
                @else
                    
                <a class="font-bold text-2xl" href="{{ route('trashed.show', $note) }}">
                        {{$note->title}}
                    </a>
                @endif
            
                    <p class="mt-2">
                        {{ Str::limit($note->text, 200) }}
                    </p>        
                    <span class="block mt-4 text-sm opacity-70">
                        {{ $note->updated_at->diffForHumans()}}
                    </span>
                </div>
            @empty
              @if( request()->routeIs('notes.index') )
                <p>There is no any notes found!</p>
                @else
                    <p>No any note in trash!</p>
                @endif
            
            @endforelse

            {{ $notes->links() }}
        </div>
    </div>

</x-app-layout>
