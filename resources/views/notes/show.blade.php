<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-alert></x-alert>
        @if( !$note->trashed() )
            <div class="flex space-x-4">
                <p class="opacity-70">
                    <strong>Created At: </strong> {{ $note->created_at->diffForHumans()}}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated At: </strong> {{ $note->updated_at->diffForHumans()}}
                </p>
                <a class="font-bold text-2xl" href="{{ route('notes.edit', $note) }}">
                    Edit Note
                </a>
                <form action="{{ route('notes.destroy', $note) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="bg-green-100">Move to Trash</button>
                </form>
            </div>
        @else
            <div class="flex space-x-4">
                <p class="opacity-70">
                    <strong>Deleted At: </strong> {{ $note->deleted_at->diffForHumans()}}
                </p>
            </div>
            <form action="{{ route('trashed.restore', $note) }}" method="post" class="ml-auto">
                @method('put')
                @csrf
                <button type="submit" class="btn btn-link">Restore</button>
            </form>
            <form action="{{ route('trashed.destroy', $note) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-link mt-4">Delete Permanantly</button>
                </form>
        @endif

            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg mt-4 mb-4">
                <h2 class="font-bold text-2xl">
                    {{$note->title}}
                </h2>
                <p class="mt-2">
                    {{ $note->text }}
                </p>
            </div>

        </div>
    </div>

</x-app-layout>
