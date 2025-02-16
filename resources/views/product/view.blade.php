<x-app-layout>
    <div x-data="productItem({{ json_encode([
        'id' => $product->id,
        'slug' => $product->slug,
        'image' => $product->image,
        'title' => $product->title,
        'quantity' => $product->quantity,
        'addToCartUrl' => route('cart.add', $product),
        'categories' => $product->categories->pluck('name'),
        'prices' => $product->prices->map(function ($price) {
            return [
                'number' => $price->number,
                'size' => $price->size,
            ];
        }),
        'alergens' => $product->alergens->pluck('name'),
        'images' => $product->images->pluck('url') 
        ]) }})"
        class="mx-auto product-view"
    >
        <x-icons.first_leave class="absolute" />
        <x-icons.second_leave class="absolute right-0 top-40 sm:top-28 z-10" />
        <div class="product_view_hero">
            <h2>
                {{$product->title}}
            </h2>
        </div>
        <div class="product-content">
            <div class="flex flex-col md:flex-row gap-3 md:gap-12 container">
                <img src="{{ $product->image }}" alt="" class="product-view-img">
                <div class="flex flex-col gap-3 md:w-1/2">
                    <div class="flex gap-4">
                        <ul>
                            <template x-for="category in product.categories" :key="category">
                                <li class="product-view-category" x-text="category"></li>
                            </template>
                        </ul>
                    </div>
                    <ul>
                        <template x-for="price in product.prices" :key="price.number">
                            <li class="flex justify-between">
                                <h4 x-text="'€ ' + price.number"></h4>
                                <div class="flex gap-2 items-center product-view-prices">
                                    <x-icons.clock class="fill-gray_400" />
                                    <h4 class="text-gray_400" x-text="price.size"></h4>
                                </div>
                            </li>
                        </template>
                    </ul>
                    <div x-data="{expanded: false}">
                        <div
                            x-show="expanded"
                            x-collapse.min.120px
                            class="text-gray-500 wysiwyg-content"
                        >
                            {!! $product->description !!}
                        </div>
                        <p class="text-right">
                            <a
                                @click="expanded = !expanded"
                                href="javascript:void(0)"
                                class="text-purple-500 hover:text-purple-700"
                                x-text="expanded ? 'Read Less' : 'Read More'"
                            ></a>
                        </p>
                    </div>
        
                    <div class="flex gap-4">
                        <x-button class="btn btn-primary" href="{{ $product->link }}" >
                            Book <x-icons.booking />
                        </x-button>
                        
                        <!-- <button
                            :disabled="product.quantity === 0"
                            @click="addToCart($refs.quantityEl.value)"
                            class="btn btn-secondary"
                            :class="product.quantity === 0 ? 'cursor-not-allowed' : 'cursor-pointer'"
                        >
                            Add to cart <x-icons.cart />
                        </button> -->
                    </div>
                </div>
            </div>
            <x-products :products="$products" header_title="More Treatments"/>
        </div>
        <x-benefits />
    </div>
</x-app-layout>
<script>
    function up(max) {
    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
    if (document.getElementById("myNumber").value >= parseInt(max)) {
        document.getElementById("myNumber").value = max;
    }
    }
    function down(min) {
        document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
        if (document.getElementById("myNumber").value <= parseInt(min)) {
            document.getElementById("myNumber").value = min;
        }
    }

</script>
<style>
    /* Quantity */
    .quantity {
        display: -ms-inline-flexbox;
        display: inline-flex;
        align-items: stretch;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .quantity .qty {
        width: 50px;
        height: 40px;
        line-height: 40px;
        background-color:transparent;
        border: 0;
        text-align: center;
        margin-bottom: 0;
    }
    .quantity button{
        color:white;
        height:auto;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>