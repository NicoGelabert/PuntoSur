<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="Chi Balance Therapies offers expert massage and holistic treatments in Ireland, helping you achieve relaxation, pain relief, and overall well-being. Our personalized therapies blend traditional and modern techniques to restore balance to your body and mind. Experience deep relaxation with our skilled therapist. Book your session today!">

        <meta name="keywords" content="Chi Balance Therapies, massage therapy, holistic treatments, relaxation massage, deep tissue massage, sports massage, wellness center, stress relief, therapeutic massage, Ireland massage, body balance, professional massage services, pain relief therapy, healing massage, mindfulness and wellness">

        
        <title inertia>{{ config('app.name', 'Chi Balance Therapies') }}</title>
    </head>
    <body>

    <main class="w-full mx-auto flex flex-col justify-evenly items-center h-screen px-10">
        <div class="enconstruccion">
            <x-application-logo />
        </div>
        <div class="w-full grid grid-cols-1 mx-16 gap-y-8 text-center">
            <h2 class="text-3xl font-bold sm:text-4xl">Página en construcción</h2>
            <hr class="h-px border-t-0 bg-transparent bg-gradient-to-r from-transparent via-neutral-500 to-transparent opacity-25 dark:opacity-100" />
            <p class="text-lg leading-8 text-gray-400">11 Main Street, Dungloe, Donegal, F94 WR6T (above Kenneth Campbell's)</p>
            <div class="flex gap-6 social-icons justify-center">
                <a href="https://wa.me/353852727422" class="h-10 w-10 aspect-square rounded-md bg-black/5 p-2 ring-1 ring-black/10" target="_blank">
                    <i class="flex text-2xl leading-none fi fi-brands-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/Chibalancetherapies" class="h-10 w-10 aspect-square rounded-md bg-black/5 p-2 ring-1 ring-black/10" target="_blank">
                    <i class="flex text-2xl leading-none fi fi-brands-facebook"></i>
                </a>
                <a href="https://maps.app.goo.gl/wAKdYQRLxSdrLY4U6" class="h-10 w-10 aspect-square rounded-md bg-black/5 p-2 ring-1 ring-black/10" target="_blank">
                    <i class="flex text-2xl leading-none fi fi-rs-map-marker"></i>
                </a>
            </div>
        </div>
    </main>
    </body>
</html>
<style>
    .enconstruccion a{
        flex-direction: column;

    }
    .enconstruccion a div{
        align-items:center;
    }
    .enconstruccion svg{
        height: auto;
        width: 8rem;
    }
</style>