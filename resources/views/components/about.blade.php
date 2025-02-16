<div class="container about">
    <h3>About Me</h3>
    @foreach ($abouts as $about)
    <div class="about-content">
        <div class="about-sub-content">
            <div class="about-short-description text-large line-clamp-4">
                {!! $about->short_description !!}
            </div>
            <div class="flex justify-center items-center md:hidden">
                <img src="{{ $about->image }}" alt="">
            </div>
            <div>
                {!! $about->signature !!}
            </div>
            <x-button href="/about" class="btn btn-primary">see more <x-icons.send /></x-button>
        </div>
        <div class="about-large-image">
            <img src="{{ $about->image }}" alt="">
        </div>
    </div>
    @endforeach
</div>