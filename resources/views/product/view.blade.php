@section('meta')
    <title>{{ $product->title }}, {{ $category->name }}</title>
    <meta name="description" content="{{ $product->short_description }}">
    <link rel="canonical" href="{{ url()->current() }}">
@endsection

<x-app-layout>
    <div  x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'title' => $product->title,
                    'price' => $product->price,
                    'addToCartUrl' => route('cart.add', $product)
                ]) }})" class=" lg:p-8 mx-auto pt-24 lg:pt-32 custom-container">
        <div class="flex flex-col md:flex-row gap-12">
            <div class="w-full md:w-1/2">
                <div
                    x-data="{
                      images: ['{{$product->image}}'],
                      activeImage: null,
                      prev() {
                          let index = this.images.indexOf(this.activeImage);
                          if (index === 0)
                              index = this.images.length;
                          this.activeImage = this.images[index - 1];
                      },
                      next() {
                          let index = this.images.indexOf(this.activeImage);
                          if (index === this.images.length - 1)
                              index = -1;
                          this.activeImage = this.images[index + 1];
                      },
                      init() {
                          this.activeImage = this.images.length > 0 ? this.images[0] : null
                      }
                    }"
                    class="max-w-fit flex flex-col-reverse lg:flex-row gap-4 md:sticky top-24" id="imagen"
                >
                    <div class="flex">
                        <template x-for="image in images">
                            <a
                                @click.prevent="activeImage = image"
                                class="cursor-pointer w-[80px] h-[80px] border flex items-center justify-center product-thumbnail"
                                :class="{'product-thumbnail-active': activeImage === image}"
                            >
                                <img :src="image" alt="" class=""/>
                            </a>
                        </template>
                    </div>
                    <div class="relative">
                        <template x-for="image in images">
                            <div
                                x-show="activeImage === image"
                                class="aspect-w-3 aspect-h-2"
                            >
                                <img :src="image" alt="" class="w-auto mx-auto"/>
                            </div>
                        </template>
                        <a
                            @click.prevent="prev"
                            class="cursor-pointer bg-black/30 text-white absolute left-0 top-1/2 -translate-y-1/2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        </a>
                        <a
                            @click.prevent="next"
                            class="cursor-pointer bg-black/30 text-white absolute right-0 top-1/2 -translate-y-1/2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 product-view" id="texto">
                <div class="flex flex-col gap-8 justify-between align-center">
                    <div class="relative">
                        <h4>{{ $product->title }}</h4>
                        <h2 class="decoration absolute top-14 lg:top-0 text-8xl">O</h2>
                    </div>
                    <div class="flex justify-between">
                        @foreach($product->prices as $price)
                        <div class="flex flex-col gap-2 items-center">
                            <p class="capitalize text-xs font-bold">{{ $price->size }}</p>
                            <h5>${{ $price->number }}</h5>
                        </div>
                        @endforeach
                        <div class="flex flex-col gap-2 items-center">
                            <p class="capitalize text-xs font-bold">Cantidad</p>
                            <div class="flex items-start quantity gap-4">
                                <button id="down" class="" onclick=" down('0')">
                                    <h5 class="text-secondary">-</h5>
                                </button>
                                <div class="flex flex-col items-center relative">
                                    <input
                                        type="number"
                                        name="quantity"
                                        x-ref="quantityEl"
                                        value="1"
                                        min="1"
                                        class="w-32 qty font-cursive text-lg"
                                        id="myNumber"
                                    />
                                    <p class="decoration text-6xl absolute top-2">e</p>
                                </div>
                                <button id="up" class="" onclick="up('9')">
                                    <h5 class="text-secondary">+</h5>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Add to cart button -->
                    <div class="add-to-cart-container flex-[1_0_100%]">
                        <button
                            @click="addToCart($refs.quantityEl.value)"
                            class="add-to-cart-button flex items-center btn btn-primary"
                        >
                        <x-icons.cart />
                        <span>Sumar al Carrito</span>
                        </button>
                    </div>
                    <!-- Add to cart button -->
                </div>
                <div>
                    <h6>Le Ponemos</h6>
                    <ul>
                        @foreach ($product->tags as $tag)
                        <li><span class="text-xs">{{ $tag->name }}</span></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h6>Alérgenos</h6>
                    <ul>
                        @foreach ($product->alergens as $alergen)
                        <li><span class="text-xs">{{ $alergen->name }}</span></li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-6" x-data="{expanded: false}">
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
                            class="text-secondary hover:text-primary"
                            x-text="expanded ? 'Ver menos' : 'Ver más'"
                        ></a>
                    </p>
                </div>
            </div>
        </div>
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
    .quantity .qty {
        width: 40px;
        height: 40px;
        line-height: 40px;
        background-color:transparent;
        border:transparent;
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