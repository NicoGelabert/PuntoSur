<template>
  <div class="p-4 bg-white shadow rounded-lg">
    <h1 v-if="!loading" class="text-2xl font-bold">
      {{ about.id ? `Update About: "${about.headline}"` : 'Create new About' }}
    </h1>
    
    <Spinner v-if="loading" class="my-4" />
    
    <form v-if="!loading" @submit.prevent="onSubmit">
      <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="col-span-2 px-4 pt-5 pb-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">About Headline</h3>
            <CustomInput class="mb-2" v-model="about.headline" label="About headline" :errors="errors['headline']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Short Description</h3>
            <CustomInput type="richtext" class="mb-2" v-model="about.short_description" label="Short Description" :errors="errors['short_description']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Large Description</h3>
            <CustomInput type="richtext" class="mb-2" v-model="about.large_description" label="Large Description" :errors="errors['large_description']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Signature</h3>
            <CustomInput type="richtext" class="mb-2" v-model="about.signature" label="Signature" :errors="errors['signature']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Mission and Vision</h3>
            <CustomInput type="richtext" class="mb-2" v-model="about.mission_an_vision" label="Mission and Vision" :errors="errors['mission_an_vision']"/>
          </div>
        </div>
        <div class="col-span-1 px-4 pt-5 pb-4">
          <h3 class="text-lg font-bold mb-2">Imagen</h3>
          <!-- Imagen Previa -->
          <div v-if="about.image_url" class="relative w-40 h-40 rounded-lg border border-dashed flex items-center justify-center overflow-hidden bg-gray-100">
            <img :src="about.image_url" alt="Previsualización" class="object-cover w-full h-full">
            <button class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600" @click="about.image_url = null">
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
        <button type="submit" class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
          Save
        </button>
        <button type="button" @click="onSubmit($event, true)" class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
          Save & Close
        </button>
        <router-link :to="{name: 'app.abouts'}" class="bg-white text-base font-medium text-gray-700 border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm" ref="cancelButtonRef">
          Cancel
        </router-link>
      </footer>
    </form>
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue';
import CustomInput from "../../components/core/CustomInput.vue";
import { useRoute, useRouter } from 'vue-router';
import store from '../../store/index.js';
import Spinner from '../../components/core/Spinner.vue';
import Treeselect from 'vue3-treeselect';
import 'vue3-treeselect/dist/vue3-treeselect.css';
import axiosClient from "../../axios.js";

const route = useRoute();
const router = useRouter();

const about = ref({
  id: null,
  headline: '',
  short_description: '',
  large_description: '',
  signature: '',
  mission_and_vision: '',
  image: '',
  image_url: '',
});

const loading = ref(false);
const errors = ref({});

function onImageChange(event) {
  const file = event?.target?.files[0];
  if (file) {
    about.value.image = file;  // Guardamos el archivo directamente
    about.value.image_url = URL.createObjectURL(file);
  }
}

// ✅ Obtención de datos cuando hay `id` en la ruta
onMounted(() => {
  if (route.params.id) {
    loading.value = true;
    store.dispatch('getAbout', route.params.id)
    .then((response) => {
      about.value = response.data || {}; // Asegurar estructura de datos
      if (about.value.image) {
        about.value.image_url = about.value.image;  // Si ya existe una imagen, la asignamos para la previsualización
      }
    })
    .catch((error) => {
      console.error('Error fetching about:', error);
    })
    .finally(() => {
      loading.value = false;
    });
  }
});

function onSubmit($event, close = false) {
  loading.value = true;
  errors.value = {};

  // Enviar el formulario con FormData (de acuerdo con el código de actions.js)
  const action = about.value.id ? 'updateAbout' : 'createAbout';

  store.dispatch(action, about.value)  // Esto ahora usa el FormData que ya tienes en actions.js
  .then(response => {
    loading.value = false;
    if (response.status === (about.value.id ? 200 : 201)) {
      about.value = response.data;
      store.commit('showToast', `About was successfully ${about.value.id ? 'updated' : 'created'}`);
      store.dispatch('getAbouts');
      
      if (close) {
        router.push({ name: 'app.abouts' });
      } else if (!about.value.id) {
        router.push({ name: 'app.abouts.edit', params: { id: response.data.id } });
      }
    }
  })
  .catch(err => {
    loading.value = false;
    errors.value = err.response.data.errors;
  });
}
</script>