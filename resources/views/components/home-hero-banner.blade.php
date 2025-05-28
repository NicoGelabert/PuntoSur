<div class="bg-black">
    @foreach ($homeherobanners as $homeherobanner)
    <div
        class="home-hero-banner"
        style="background-image: url('{{ $homeherobanner->image }}')"
        title="{{ $homeherobanner->headline }}"
    >
        <!-- Podés poner contenido adentro si querés -->
        <div class="hhb-content">
            <div class="custom-container">
                <div class="hhb-content-text">
                    <h2>{{ $homeherobanner->headline }}</h2>
                    <p>{!! $homeherobanner->description !!}</p>
                    <button class="btn btn-primary">Order Now</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>