<template>
    <div>
        <div class="flex flex-col md:flex-row justify-between mb-3 w-full gap-4">
            <h1 class="text-3xl font-semibold">Home Hero Banner</h1>
            <router-link type="button" :to="{name: 'app.homeherobanners.create'}"
                        class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:text-black hover:bg-white focus:outline-none text-center"
            >
            Nuevo Banner
            </router-link>
        </div>
        <HomeHeroBannersTable />
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import store from "../../store";
import HomeHeroBannersTable from "./HomeHeroBannersTable.vue";

const homeHeroBanners = computed(() => store.state.homeHeroBanners);
</script>