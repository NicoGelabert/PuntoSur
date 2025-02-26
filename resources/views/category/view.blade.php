<x-app-layout>
    <div class="category-view">
        <x-icons.first_leave class="absolute pointer-events-none" />
        <x-icons.second_leave class="absolute pointer-events-none right-0 top-40 sm:top-28 z-10" />
        <div class="category_index_hero">
            <h2>
                {{ $category->name }}
            </h2>
        </div>
        <div class="card_list_container">
            <div class="card_list container">
                @foreach ($products as $product)
                <div class="card">
                    <div class="card_image">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}">
                    </div>
                    <div class="card_content">
                        <div class="card_content_text">
                            <h5>{{ $product->title }}</h5>
                            <div class="trunkated_text">
                                {!! $product->description !!}
                            </div>
                        </div>
                        <div class="flex gap-2">
                            @if ($product->link)
                                <x-button href="{{ $product->link }}" class="btn btn-primary" target="_blank">book <x-icons.booking /></x-button>
                            @endif
                            <x-button href="{{ route('product.view', ['category' => $product->categories->first()->slug, 'product' => $product->slug]) }}" class="btn btn-secondary">See more <x-icons.send /></x-button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>