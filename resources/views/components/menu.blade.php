@props([
    'layout' => 'row', // Valor por defecto: disposición en fila
    'gap' => '4',      // Valor por defecto: espacio entre elementos
])

<nav {{ $attributes->merge(['class' => "flex flex-$layout gap-$gap container justify-between items-center"]) }}>
    <div class="logo flex justify-center">
        <x-application-logo/>
    </div>
    <ul class="grid lg:grid-flow-col items-center justify-end gap-4 text-center">
        <li x-data="{open: false}" >
            <!-- <a
                @click="open = !open"
                :class="{'w-full': open}"
                class="cursor-pointer flex justify-center items-center"
            > -->
            <a
                href="/all"
                class="cursor-pointer flex justify-center items-center"
            >
            Menú
                <!-- <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg> -->
            </a>
        </li>
        <li>
            <a href="/all/gift-cards/">
                Sobre Nosotros
            </a>
        </li>
        <li>
            <a href="/contact">
                Contacto
            </a>
        </li>
        <li class="flex gap-4">
            <x-button href="/" class="btn btn-secondary">Consultanos <x-icons.whatsapp /></x-button>
        </li>
    </ul>
</nav>