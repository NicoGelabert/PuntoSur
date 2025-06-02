<x-app-layout>
    <x-home-hero-banner :homeherobanners="$homeherobanners" />
    <div class="home-product-list custom-container">
        <product-list :products='@json($products)' :categories='@json($categories)' />
    </div>
    <x-promotion />
    <x-history />
</x-app-layout>