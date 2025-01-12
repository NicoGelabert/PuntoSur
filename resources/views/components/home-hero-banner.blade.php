<div class="home-hero-banner container splide" aria-label="Chi Balance Therapies">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($homeherobanners as $homeherobanner)
            <li class="splide__slide">
                <div class="home-hero-banner-content">
                    <div class="home-hero-banner-content-text">
                        <h2 class="animate-h2">{{ $homeherobanner->headline }}</h1>
                        <p class="text-large animate-p">{{ $homeherobanner->description }}</p>
                        <div class="animate-button">
                            <x-button class="btn btn-primary" href="{{ $homeherobanner->link }}">See more <x-icons.send /></x-button>
                        </div>
                    </div>
                    <div class="home-hero-banner-content-img">
                        <img src="{{ $homeherobanner->image }}" alt="{{ $homeherobanner->title }}" class="animate-img">
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>