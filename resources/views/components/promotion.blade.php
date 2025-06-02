<div class="fondo_degradado relative">
    <div class="w-full absolute top-0 flex h-full">
        <div class="h-full flex flex-col justify-between w-1/2">
            <div class="izquierdo-superior md:h-1/2">
                <img src="{{ asset('storage/images/common/promo-izquierdo-superior.png') }}" alt="" class="h-auto md:h-full w-auto">
            </div>
            <div class="izquierdo-inferior md:h-1/2">
                <img src="{{ asset('storage/images/common/promo-izquierdo-inferior.png') }}" alt="" class="h-auto md:h-full w-auto">
            </div>
        </div>
        <div class="h-full flex flex-col justify-between w-1/2 items-end">
            <div class="derecho-superior md:h-1/2">
                <img src="{{ asset('storage/images/common/promo-derecho-superior.png') }}" alt="" class="h-auto md:h-full w-auto">
            </div>
            <div class="derecho-inferior md:h-1/2">
                <img src="{{ asset('storage/images/common/promo-derecho-inferior.png') }}" alt="" class="h-auto md:h-full w-auto">
            </div>
        </div>
    </div>
    <div class="custom-container flex flex-col-reverse md:flex-row gap-4 md:gap-8 items-center pt-20 md:pt-0">
        <div class="md:w-1/2">
            <img src="{{ asset('storage/images/common/comiendo-tarta.png') }}" alt="">
        </div>
        <div class="md:w-1/2 flex flex-col gap-16 items-center">
            <div>
                <h3 class="text-center lg:mb-8">¿Se aproxima un festejo?</h3>
                <p class="text-center lg:mb-8">Hacemos todo tipo de tortas por encargo<br/>¡Consultanos!</p>
            </div>
            <div class="relative">
                <p class="decoration text-8xl md:text-9xl absolute bottom-0 left-1/2 -translate-x-1/2 mb-8">n</p>
                <x-button class="btn btn-primary">Escribinos</x-button>
            </div>
        </div>
    </div>
</div>