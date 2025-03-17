<x-app-layout>
    <div id="news_view">
        <x-icons.first_leave class="absolute pointer-events-none" />
        <x-icons.second_leave class="absolute pointer-events-none right-0 top-40 sm:top-28 z-10" />
        <div class="news_view_hero">
            <div class="news_content_header">
                @foreach ($article->authors as $author)
                <div class="author">
                    <img src="{{ $author->image }}" alt="">
                    <h6>{{ $author->name }}</h6>
                </div>
                @endforeach
                <p class="dot_divider">·</p>
                <p class="news_date">{{ $article->created_at->format('M d, Y') }}</p>
            </div>
            <h2>
                {{$article->title}}
            </h2>
            <p>
                {{ $article->subtitle }}
            </p>
        </div>
        <div class="news_content">
            <div class="max-w-screen-lg mx-auto">
                <div class="flex flex-col-reverse md:flex-row gap-8 md:gap-4 lg:md:gap-8">
                    <img src="{{ $article->image }}" alt="" class="news_view_img">
                    <div class="news_lead">
                        <p class="">{{ $article->news_lead }}</p>
                    </div>
                </div>
                <div class="description">
                    <p> {!! $article->description !!}</p>
                </div>
            </div>
            <div class="news_gallery splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($article->images->skip(1) as $image)
                        <li class="splide__slide">
                            <img src="{{ $image->url }}" alt="" class="max-w-36">
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>