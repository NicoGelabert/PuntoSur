<div class="container news splide" aria-label="Latest news">
    <div class="news-title">
        <h3>Healthy News</h3>
        <a href="/articles">See More <x-icons.chevron /></a>
    </div>
    <div class="splide__track">
        <ul class="splide__list">
            @foreach ($articles as $article)
            <li class="news-card splide__slide">
                <a href="{{ route('news.view', ['article' => $article->slug]) }}">
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
                        <p class="description">{{ $article->news_lead }}</p>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>