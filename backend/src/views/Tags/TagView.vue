<template>
  <div class="p-4 bg-white shadow rounded-lg">
    <h1 v-if="!loading" class="text-2xl font-bold">
      {{ tag.id ? `Editar Tag: "${tag.name}"` : 'Crear Nuevo Tag' }}
    </h1>
    
    <Spinner v-if="loading" class="my-4" />
    
    <form v-if="!loading" @submit.prevent="onSubmit">
      <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="col-span-2 px-4 pt-5 pb-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Nombre</h3>
            <CustomInput class="mb-2" v-model="tag.name" label="Nombre del Tag" :errors="errors['name']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Descripción</h3>
            <CustomInput type="richtext" class="mb-2" v-model="tag.description" label="Description" :errors="errors['description']"/>
          </div>
          <hr class="my-4">
          <CustomInput type="select" :select-options="parentTags" class="mb-2" v-model="tag.parent_id" label="Parent" :errors="errors['parent_id']"/>
          <hr class="my-4">
          <CustomInput type="checkbox" class="mb-2" v-model="tag.active" :label="tag.active ? 'Publicado' : 'No publicado'" :errors="errors['active']"/>
        </div>
        <div class="col-span-1 px-4 pt-5 pb-4">
          <h3 class="text-lg font-bold mb-2">Imagen</h3>
          <!-- Imagen Previa -->
          <div v-if="tag.image_url" class="relative w-40 h-40 rounded-lg border border-dashed flex items-center justify-center overflow-hidden bg-gray-100">
            <img :src="tag.image_url" alt="Previsualización" class="object-cover w-full h-full">
            <button class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600" @click="tag.image_url = null">
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
          Guardar
        </button>
        <button type="button" @click="onSubmit($event, true)" class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
          Guardar y Cerrar
        </button>
        <router-link :to="{name: 'app.tags'}" class="bg-white text-base font-medium text-gray-700 border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm" ref="cancelButtonRef">
          Cancelar
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

const tag = ref({
  id: null,
  name: '',
  description: '',
  parent_id: '',
  image: '',
  image_url: '',
  active: false,
});

const loading = ref(false);
const errors = ref({});

// ✅ Manejo correcto de la lista de autores
const parentTags = computed(() => [
  { key: '', text: 'Seleccione Superior' },
  ...store.state.tags.data
  .filter(c => !tag.value.id || c.id !== tag.value.id)
  .map(c => ({ key: c.id, text: c.name }))
  .sort((c1, c2) => c1.text.localeCompare(c2.text))
]);

function onImageChange(event) {
  const file = event?.target?.files[0];
  if (file) {
    tag.value.image = file;  // Guardamos el archivo directamente
    tag.value.image_url = URL.createObjectURL(file);
  }
}

// ✅ Obtención de datos cuando hay `id` en la ruta
onMounted(() => {
  if (route.params.id) {
    loading.value = true;
    store.dispatch('getTag', route.params.id)
    .then((response) => {
      tag.value = response.data.data || {}; // Asegurar estructura de datos
      if (tag.value.image) {
        tag.value.image_url = tag.value.image;  // Si ya existe una imagen, la asignamos para la previsualización
      }
    })
    .catch((error) => {
      console.error('Error fetching tag:', error);
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
  const action = tag.value.id ? 'updateTag' : 'createTag';

  store.dispatch(action, tag.value)  // Esto ahora usa el FormData que ya tienes en actions.js
  .then(response => {
    loading.value = false;
    if (response.status === (tag.value.id ? 200 : 201)) {
      tag.value = response.data;
      store.commit('showToast', `El alérgeno fue ${tag.value.id ? 'updated' : 'created'} con éxito`);
      store.dispatch('getTags');
      
      if (close) {
        router.push({ name: 'app.tags' });
      } else if (!tag.value.id) {
        router.push({ name: 'app.tags.edit', params: { id: response.data.id } });
      }
    }
  })
  .catch(err => {
    loading.value = false;
    errors.value = err.response.data.errors;
  });
}
</script>