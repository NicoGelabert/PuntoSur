@props(['benefits' => null])
<div class="container about">
    <h3>Benefits</h3>
    <div class="about-content">
        <div class="about-sub-content">
            @if ($benefits && $benefits instanceof \Illuminate\Support\Collection && $benefits->isNotEmpty())
                <ul>
                    @foreach ($benefits as $benefit)
                    <li>{{ $benefit->text }}</li> {{-- Aquí puedes acceder a los datos específicos del beneficio --}}
                    @endforeach
                </ul>
            @else
            <ul>
                <li><p class="text-large">Works on your nervous system, helping to release stress.</p></li>
                <li><p class="text-large">Increases blood circulation, which releases stiff muscles.</p></li>
                <li><p class="text-large">Flushes toxins trapped in your lymphatic system.</p></li>
                <li><p class="text-large">Releases tension and pain from sore muscles.</p></li>
            </ul>
            @endif
        </div>
        <div class="about-large-image">
            <img src="{{ asset('storage/common/masajes-008.jpg') }}" alt="">
        </div>
    </div>
</div>