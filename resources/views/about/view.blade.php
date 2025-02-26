<x-app-layout>
    <div id="about_view">
        <x-icons.first_leave class="absolute pointer-events-none" />
        <x-icons.second_leave class="absolute pointer-events-none right-0 top-40 sm:top-28 z-10" />
        <div class="about_view_hero">
            <h2>
                {{$about->headline}}
            </h2>
        </div>
        <div class="about_content">
            <div class="max-w-screen-lg mx-auto">
                <div class="flex flex-col-reverse md:flex-row gap-8 md:gap-4 lg:md:gap-8">
                    <img src="{{ $about->image }}" alt="" class="about_view_img">
                    <div class="about_short_description">
                        <p class="">{!! $about->short_description !!}</p>
                    </div>
                </div>
                <div class="large_description">
                    {!! $about->large_description !!}
                </div>
                <div>
                    {!! $about->signature !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>