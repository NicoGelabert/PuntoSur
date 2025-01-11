@props([
    'layout' => 'row', // Valor por defecto: disposición en fila
    'gap' => '4',      // Valor por defecto: espacio entre elementos
])

<nav {{ $attributes->merge(['class' => "flex flex-$layout gap-$gap container mx-4 justify-between items-center"]) }}>
    <div class="logo flex justify-center">
        <x-application-logo/>
    </div>
    <ul class="grid lg:grid-flow-col items-center justify-end gap-4">
        <li x-data="{open: false}" class="relative">
            <a
                @click="open = !open"
                :class="{'w-full': open}"
                class="cursor-pointer flex items-center"
            >
            Treatments
                <svg
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
                </svg>
            </a>
        </li>
        <li>
            <a href="#">
                Blends
            </a>
        </li>
        <li>
            <a href="#">
                Promos
            </a>
        </li>
        <li>
            <a href="#">
                About Me
            </a>
        </li>
        <li>
            <a href="#">
                News
            </a>
        </li>
        <div>
            <x-button href="#" class="btn btn-secondary">log in <x-icons.login /></x-button>
        </div>
        <div>
            <x-button href="#" class="btn btn-primary">book <x-icons.booking /></x-button>
        </div>
    </ul>
</nav>