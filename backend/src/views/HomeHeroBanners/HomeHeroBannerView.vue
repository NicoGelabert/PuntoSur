<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="flex items-center justify-between mb-3">
    <h1 v-if="!loading" class="text-3xl font-semibold">
      {{ homeHeroBanner.id ? `Editar Banner: "${homeHeroBanner.headline}"` : 'Crear Nuevo Banner' }}
    </h1>
  </div>
  <div class="bg-white rounded-lg shadow animate-fade-in-down">
    <Spinner v-if="loading"
              class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center z-50"/>
    <form v-if="!loading" @submit.prevent="onSubmit">
      <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="col-span-2 px-4 pt-5 pb-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Título</h3>
            <CustomInput class="mb-2" v-model="homeHeroBanner.headline" label="Título del Banner" :errors="errors['headline']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Descripción</h3>
            <CustomInput type="richtext" class="mb-2" v-model="homeHeroBanner.description" label="Description" :errors="errors['description']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Link</h3>
            <CustomInput type="text" class="mb-2" v-model="homeHeroBanner.link" label="Link" :errors="errors['link']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Otra Información</h3>
            <CustomInput type="richtext" class="mb-2" v-model="homeHeroBanner.other_info" label="Otra Información" :errors="errors['other_info']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Publicar</h3>
            <CustomInput type="checkbox" class="mb-2" v-model="homeHeroBanner.published" :label="homeHeroBanner.published ? 'Publicado' : 'No publicado'" :errors="errors['published']"/>
          </div>
        </div>
        <div class="col-span-1 px-4 pt-5 pb-4">
          <h3 class="text-lg font-bold mb-2">Imagen</h3>
          <!-- Imagen Previa -->
          <div v-if="homeHeroBanner.image_url" class="relative w-40 h-40 rounded-lg border border-dashed flex items-center justify-center overflow-hidden bg-gray-100">
            <img :src="homeHeroBanner.image_url" alt="Previsualización" class="object-cover w-full h-full">
            <button class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600" @click="homeHeroBanner.image_url = null">
              ✕
            </button>
          </div>
          <!-- Input para Cargar Imagen -->
           <div v-else class="relative w-40 h-40 rounded-lg border border-dashed flex items-center justify-center hover:border-purple-500 overflow-hidden bg-gray-50">
            <label class="flex flex-col items-center justify-center cursor-pointer text-gray-600 hover:text-purple-500">
              <span>Seleccionar Imagen</span>
              <input type="file" class="absolute inset-0 opacity-0 cursor-pointer" @change="onImageChange" />
            </label>
          </div>
        </div>
      </div>
      <footer class="bg-gray-50 rounded-b-lg px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="submit"
                class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
          Guardar
        </button>
        <button type="button"
                @click="onSubmit($event, true)"
                class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
          Guardar y Cerrar
        </button>
        <router-link :to="{name: 'app.homeherobanners'}"
                      class="bg-white text-base font-medium text-gray-700 border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm"
                      ref="cancelButtonRef">
          Cancelar
        </router-link>
      </footer>
    </form>
  </div>
</template>
  
<script setup>
import {onMounted, ref} from 'vue'
import CustomInput from "../../components/core/CustomInput.vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/Spinner.vue";
import {useRoute, useRouter} from "vue-router";
import ImagePreview from "../../components/ImagePreview.vue";
import {PlusCircleIcon, TrashIcon} from '@heroicons/vue/24/solid';
import axiosClient from "../../axios.js";

const route = useRoute()
const router = useRouter()

const homeHeroBanner = ref({
  id: null,
  headline: '',
  image: '',
  description: '',
  link: '',
  other_info: '',
  published: false,
})

const errors = ref({});

const loading = ref(false);

function onImageChange(event) {
  const file = event?.target?.files[0];
  if (file) {
    homeHeroBanner.value.image = file;  // Guardamos el archivo directamente
    homeHeroBanner.value.image_url = URL.createObjectURL(file);
  }
}

const emit = defineEmits(['update:modelValue', 'close'])

onMounted(() => {
  if (route.params.id) {
    loading.value = true
    store.dispatch('getHomeHeroBanner', route.params.id)
      .then((response) => {
        loading.value = false;
        homeHeroBanner.value = response.data;
      })
  }
})

function onSubmit($event, close = false) {
  loading.value = true
  errors.value = {};
  if (homeHeroBanner.value.id) {
    store.dispatch('updateHomeHeroBanner', homeHeroBanner.value)
      .then(response => {
        loading.value = false;
        if (response.status === 200) {
          homeHeroBanner.value = response.data
          store.commit('showToast', 'El banner se actualizó con éxito');
          store.dispatch('getHomeHeroBanners')
          if (close) {
            router.push({name: 'app.homeherobanners'})
          }
        }
      })
      .catch(err => {
        loading.value = false;
        errors.value = err.response.data.errors
      })
  } else {
    store.dispatch('createHomeHeroBanner', homeHeroBanner.value)
      .then(response => {
        loading.value = false;
        if (response.status === 201) {
          homeHeroBanner.value = response.data
          store.commit('showToast', 'El banner fue creado con éxito');
          store.dispatch('getHomeHeroBanners')
          if (close) {
            router.push({name: 'app.homeherobanners'})
          } else {
            homeHeroBanner.value = response.data
            router.push({name: 'app.homeherobanners.edit', params: {id: response.data.id}})
          }
        }
      })
      .catch(err => {
        loading.value = false;
        errors.value = err.response.data.errors
      })
  }
}
</script>
  