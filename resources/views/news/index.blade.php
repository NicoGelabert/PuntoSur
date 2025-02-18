<x-app-layout>
    <div id="news_index">
        <x-icons.first_leave class="absolute" />
        <x-icons.second_leave class="absolute right-0 top-20 sm:top-28 z-10" />
        <div class="news_index_hero">
            <h2>Latest news</h3>
        </div>
        <div class="bg-blue_light py-12">
            <div class="news_list container">
                @foreach ($articles as $article)
                <a href="{{ route('news.view', ['article' => $article->slug]) }}">
                    <div class="news-card">
                        <div class="news-card-img">
                            <img src="{{ $article->image }}" alt="">
                        </div>
                        <div class="news-card-content">
                            <div class="news-card-content-header">
                                @foreach ($article->authors as $author)
                                <div class="author">
                                    <img src="{{ $author->image }}" alt="">
                                    <h6>{{ $author->name }}</h6>
                                </div>
                                @endforeach
                                <p class="dot-divider">·</p>
                                <p class="news-date">{{ $article->created_at->format('M d, Y') }}</p>
                            </div>
                            <h5>{{ $article->title }}</h5>
                            <div class="line-clamp-2">
                                <p class="description">{{ $article->news_lead }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>