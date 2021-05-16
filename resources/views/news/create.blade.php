<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
            {{--{{ $news->title }}--}}
        </h2>
        <a href="{{ route('news.create') }}">Create</a>
    </x-slot>

    <x-content-body>
        <div class="my-8">
            <x-auth-validation-errors :errors="$errors" />
        </div>
        <form method="POST" action="{{ route('news.store') }}"> {{--class="max-w-md"--}}
        @csrf

        <!-- Email Address -->
            <div>
                <x-label for="title" :value="__('Title')" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />
                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="category_id" :value="__('Category')" />
                <select name="category_id" id="category_id"> {{--class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"--}}
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-button class="ml-3">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>
    </x-content-body>
</x-app-layout>
