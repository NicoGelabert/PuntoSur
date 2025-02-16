<x-app-layout>
    <div id="about_view">
        <x-icons.first_leave class="absolute" />
        <x-icons.second_leave class="absolute right-0 top-40 sm:top-28 z-10" />
        <div class="about_view_hero">
            <h2>
                {{$about->headline}}
            </h2>
        </div>
    </div>
</x-app-layout>