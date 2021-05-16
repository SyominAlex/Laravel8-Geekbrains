{{--
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
--}}
{{--    {{ $news }}--}}{{--

    <ul>
        @foreach($news as $newsItem)
            <li><a href="{{ route('news.show', ['news' => $newsItem]) }}">({{ $newsItem->category->name }}) {{ $newsItem->title }}</a></li>
        @endforeach
    </ul>
</body>
</html>
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <x-content-body>
        @if(session()->has('success'))
            <div class="mb-6 bg-green-200 text-green-700 px-3 px-2 rounded-lg">{{ session()->get('success') }}</div>
        @endif
            {{--@if($news->isNotEmpty())
                @foreach($news as $newsItem)
                    <li>#{{ $newsItem->id }}. <a href="{{ route('news.show', ['news' => $newsItem]) }}">{{ $newsItem->title }}</a></li>
                @endforeach
            @else
                <p>There's no news for today</p>
            @endif--}}
            <div class="flex flex-wrap justify-between -mx-3">
                @forelse($news as $newsItem)
                    {{--<li>#{{ $newsItem->id }}. <a href="{{ route('news.show', ['news' => $newsItem]) }}">{{ $newsItem->title }}</a></li>--}}
                        <div class="w-full md:w-1/3 lg:1/4 px-3">
                            <x-news.news-preview :news="$newsItem"/>
                        </div>
                @empty
                    <p>There's no news for today</p>
                @endforelse
            </div>
    </x-content-body>

</x-app-layout>
