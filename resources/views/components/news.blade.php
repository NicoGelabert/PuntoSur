@php
    $firstArticle = $articles->shift(); // Extrae el primer artículo
@endphp
<div class="container news" aria-label="Latest news">
    <div class="news-title">
        <h3>Healthy News</h3>
        <a href="/articles">See More <x-icons.chevron /></a>
    </div>
    <div class="news_card">
        <div class="flex-1 news_card_first">
            <a href="{{ route('news.view', ['article' => $firstArticle->slug]) }}" class="flex flex-col gap-4">
                <img src="{{ $firstArticle->image }}" alt="">
                <div class="news-card-content-header">
                    @foreach ($firstArticle->authors as $author)
                    <div class="author">
                        <img src="{{ $author->image }}" alt="">
                        <h6>{{ $author->name }}</h6>
                    </div>
                    @endforeach
                    <p class="dot-divider">·</p>
                    <p class="news-date">{{ $firstArticle->created_at->format('M d, Y') }}</p>
                </div>
                <h5>{{ $firstArticle->title }}</h5>
                <div class="line-clamp-2">
                    <p class="description">{{ $firstArticle->news_lead }}</p>
                </div>
            </a>
        </div>
        <div class="flex-1">
            @foreach ($articles as $article)
            <a href="{{ route('news.view', ['article' => $article->slug]) }}">
                <div class="news_list_item">
                    <img src="{{ $article->image }}" alt="">
                    <h6>{{ $article->title }}</h6>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>