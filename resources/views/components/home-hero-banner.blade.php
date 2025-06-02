<div class="home-hero-banner fondo_degradado">
    <div class="w-full absolute top-0 flex h-full">
        <div class="h-full flex flex-col justify-between w-1/2">
            <div class="izquierdo-superior md:h-1/2">
                <img src="{{ asset('storage/images/common/izquierdo-superior.png') }}" alt="" class="h-auto md:h-full w-auto">
            </div>
            <div class="izquierdo-inferior md:h-1/2">
                <img src="{{ asset('storage/images/common/izquierdo-inferior.png') }}" alt="" class="h-auto md:h-full w-auto">
            </div>
        </div>
        <div class="h-full flex flex-col justify-between w-1/2 items-end">
            <div class="derecho-superior md:h-1/2">
                <img src="{{ asset('storage/images/common/derecho-superior.png') }}" alt="" class="h-auto md:h-full w-auto">
            </div>
            <div class="derecho-inferior md:h-1/2">
                <img src="{{ asset('storage/images/common/derecho-inferior.png') }}" alt="" class="h-auto md:h-full w-auto">
            </div>
        </div>
    </div>
    @foreach ($homeherobanners as $homeherobanner)
    <div class="custom-container h-full flex flex-col md:flex-row items-center relative z-10">
        <div class="hhb-content">
            <div class="hhb-content-text">
                <h2>{{ $homeherobanner->headline }}</h2>
                <p>{!! $homeherobanner->description !!}</p>
                <div class="relative">
                    <button class="btn btn-primary">Order Now</button>
                    <p class="decoration">m</p>
                </div>
            </div>
        </div>
        <div class="hhb-bg-image">
            <img src="{{ $homeherobanner->image }}" alt="{{ $homeherobanner->headline }}">
        </div>
    </div>
    @endforeach
    
    <!-- <div class="w-full absolute -bottom-px">
        <x-waves />
    </div> -->
</div>