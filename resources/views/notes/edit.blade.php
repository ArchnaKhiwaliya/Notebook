<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 sm:rounded-lg mt-4 mb-4">
            <div class="w-full max-w-xs">
                <form class="bg-white px-8 pt-6 pb-8 mb-4" action="{{ route('notes.update', $note) }}" method="post"> 
                    @method('put')
                    @csrf
                    <x-text-input type="text" name="title" placeholder="Enter Note Title" class="w-full" autocomplete="off" value="{{$note->title}}">  </x-text-input>
                    @error('title')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror

                    <x-textarea name="text" placeholder="Enter Note Content" class="w-full mt-6" autocomplete="off" value="{{$note->text}}"></x-textarea>
                    @error('text')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                    <x-primary-button class="mt-6">Save</x-primary-button>
                </form>
                
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
