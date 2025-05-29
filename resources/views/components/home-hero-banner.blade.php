<div class="home-hero-banner">
    @foreach ($homeherobanners as $homeherobanner)
    <div class="custom-container h-full flex flex-col md:flex-row items-center">
        <div class="hhb-content">
            <div class="hhb-content-text">
                <h2>{{ $homeherobanner->headline }}</h2>
                <p>{!! $homeherobanner->description !!}</p>
                <button class="btn btn-primary">Order Now</button>
            </div>
        </div>
        <div class="hhb-bg-image">
            <img src="{{ $homeherobanner->image }}" alt="{{ $homeherobanner->headline }}">
        </div>
    </div>
    @endforeach
    <div class="w-full absolute bottom-0">
        <x-waves />
    </div>
</div>