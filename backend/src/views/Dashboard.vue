<template>
  <div class="mb-2 flex flex-col md:flex-row justify-between">
    <h1 class="text-3xl font-semibold">Dashboard</h1>
    <div class="flex flex-col md:flex-row itens-start md:items-center">
      <label class="mr-2">Change Date Period</label>
      <CustomInput type="select" v-model="chosenDate" @change="onDatePickerChange" :select-options="dateOptions"/>
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
    <!--    Active Hero Banners-->
    <router-link :to="{name: 'app.homeherobanners'}">
      <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center">
        <label class="text-lg font-semibold block mb-2">Active Hero Banners</label>
        <template v-if="!loading.homeHeroBannerCount">
          <span class="text-3xl font-semibold">{{ homeHeroBannerCount }}</span>
        </template>
        <Spinner v-else text="" class=""/>
      </div>
    </router-link>
    <!--/    Active Hero Banners-->
    <!--    Active Categories-->
    <router-link :to="{name: 'app.categories'}">
      <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center">
        <label class="text-lg font-semibold block mb-2">Active Categories</label>
        <template v-if="!loading.categoryCount">
          <span class="text-3xl font-semibold">{{ categoryCount }}</span>
        </template>
        <Spinner v-else text="" class=""/>
      </div>
    </router-link>
    <!--/    Active Categories-->
    
    <!--    Active Products -->
    <router-link :to="{name: 'app.products'}">
      <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center"
           style="animation-delay: 0.1s">
        <label class="text-lg font-semibold block mb-2">Active Treatments</label>
        <template v-if="!loading.productsCount">
          <span class="text-3xl font-semibold">{{ productsCount }}</span>
        </template>
        <Spinner v-else text="" class=""/>
      </div>
    </router-link>
    <!--/    Active Products -->
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
    <!--    Active Articles-->
    <router-link :to="{name: 'app.articles'}">
      <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center">
        <label class="text-lg font-semibold block mb-2">Active Articles</label>
        <template v-if="!loading.articlesCount">
          <span class="text-3xl font-semibold">{{ articlesCount }}</span>
        </template>
        <Spinner v-else text="" class=""/>
      </div>
    </router-link>
    <!--/    Active Articles-->
    <!--    Active Authors-->
    <router-link :to="{name: 'app.authors'}">
      <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center">
        <label class="text-lg font-semibold block mb-2">Active Authors</label>
        <template v-if="!loading.authorsCount">
          <span class="text-3xl font-semibold">{{ authorsCount }}</span>
        </template>
        <Spinner v-else text="" class=""/>
      </div>
    </router-link>
    <!--/    Active Authors-->
    
    <!--    Active Clients -->
    <router-link :to="{name: 'app.clients'}">
      <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center"
           style="animation-delay: 0.1s">
        <label class="text-lg font-semibold block mb-2">Active Clients</label>
        <template v-if="!loading.clientsCount">
          <span class="text-3xl font-semibold">{{ clientsCount }}</span>
        </template>
        <Spinner v-else text="" class=""/>
      </div>
    </router-link>
    <!--/    Active Clients -->
  </div>

  <div class="grid grid-rows-1 md:grid-rows-2 md:grid-flow-col grid-cols-1 md:grid-cols-3 gap-3">
    <div class="col-span-1 md:col-span-3 row-span-1 md:row-span-2 bg-white py-6 px-5 rounded-lg shadow">
      <label class="text-lg font-semibold block mb-2">Latest Clients</label>
      <template v-if="!loading.latestClients">
        <div v-for="o of latestClients" :key="o.id" class="py-2 px-3 hover:bg-gray-50">
          <p>
            <router-link :to="{name: 'app.clients.edit', params: {id: c.id}}" v-for="c of latestClients" :key="c.id" class="text-indigo-700 font-semibold">
              {{ c.full_name }} | {{ c.age }} | {{ c.town }}
            </router-link>
          </p>
        </div>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
  </div>

</template>

<script setup>
import {UserIcon} from '@heroicons/vue/24/outline'
import DoughnutChart from '../components/core/Charts/Doughnut.vue'
import axiosClient from "../axios.js";
import {computed, onMounted, ref} from "vue";
import Spinner from "../components/core/Spinner.vue";
import CustomInput from "../components/core/CustomInput.vue";
import {useStore} from "vuex";

const store = useStore();
const dateOptions = computed(() => store.state.dateOptions);
const chosenDate = ref('all')

const loading = ref({
  homeHeroBannerCount: true,
  categoryCount: true,
  productsCount: true,
  articlesCount: true,
  authorsCount: true,
  clientsCount: true,
  latestClients: true
})
const homeHeroBannerCount = ref(0);
const categoryCount = ref(0);
const productsCount = ref(0);
const articlesCount = ref(0);
const authorsCount = ref(0);
const clientsCount = ref(0);
const latestClients = ref([]);

function updateDashboard() {
  const d = chosenDate.value
  loading.value = {
    homeHeroBannerCount: true,
    categoryCount: true,
    productsCount: true,
    articlesCount: true,
    authorsCount: true,
    clientsCount: true,
    latestClients: true
  }
  axiosClient.get(`/dashboard/home-hero-banner-count`, {params: {d}}).then(({data}) => {
    homeHeroBannerCount.value = data
    loading.value.homeHeroBannerCount = false;
  })
  axiosClient.get(`/dashboard/category-count`, {params: {d}}).then(({data}) => {
    categoryCount.value = data
    loading.value.categoryCount = false;
  })
  axiosClient.get(`/dashboard/products-count`, {params: {d}}).then(({data}) => {
    productsCount.value = data;
    loading.value.productsCount = false;
  })
  axiosClient.get(`/dashboard/articles-count`, {params: {d}}).then(({data}) => {
    articlesCount.value = data
    loading.value.articlesCount = false;
  })
  axiosClient.get(`/dashboard/authors-count`, {params: {d}}).then(({data}) => {
    authorsCount.value = data
    loading.value.authorsCount = false;
  })
  axiosClient.get(`/dashboard/clients-count`, {params: {d}}).then(({data}) => {
    clientsCount.value = data;
    loading.value.clientsCount = false;
  })
  axiosClient.get(`/dashboard/latest-clients`, {params: {d}}).then(({data}) => {
    latestClients.value = data;
    loading.value.latestClients = false;
  })
}

function onDatePickerChange() {
  updateDashboard()
}

onMounted(() => updateDashboard())
</script>

<style scoped>

</style>
