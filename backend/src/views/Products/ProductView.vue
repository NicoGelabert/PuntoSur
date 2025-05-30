<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="flex items-center justify-between mb-3">
    <h1 v-if="!loading" class="text-3xl font-semibold">
      {{ product.id ? `Editar Producto: "${product.title}"` : 'Crear Nuevo Producto' }}
    </h1>
  </div>
  <div class="bg-white rounded-lg shadow animate-fade-in-down">
    <Spinner v-if="loading"
              class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center z-50"/>
    <form v-if="!loading" @submit.prevent="onSubmit">
      <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="col-span-2 px-4 pt-5 pb-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Nombre</h3>
            <CustomInput class="mb-2" v-model="product.title" label="Nombre del Producto" :errors="errors['title']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Categoría</h3>
            <treeselect v-model="product.categories" :multiple="true" :options="categoriesOptions" :errors="errors['categories']" label="Seleccione una categoría"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Alérgenos</h3>
            <treeselect v-model="product.alergens" :multiple="true" :options="alergensOptions" :errors="errors['alergens']" label="Seleccione uno o más alérgenos"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Descripción</h3>
            <CustomInput type="richtext" class="mb-2" v-model="product.description" label="Descripción" :errors="errors['description']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Link</h3>
            <CustomInput type="text" class="mb-2" v-model="product.link" label="Link" :errors="errors['link']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Precios</h3>
            <div v-for="(price, index) in product.prices" :key="index" class="flex gap-1">
              <CustomInput 
                v-model="price.number" 
                type="number" 
                class="mb-2 w-4/12" 
                label="Precio" 
                prepend="$" 
                :errors="errors[`prices.${index}.number`]" 
              />
              <CustomInput 
                v-model="price.size" 
                type="text" 
                class="mb-2 w-7/12" 
                label="Tamaño" 
                :errors="errors[`prices.${index}.size`]" 
              />
              <div class="w-1/12 flex items-center justify-center">
                <button class="group border-0 rounded-full hover:bg-black" v-if="product.prices.length > 1" @click.prevent="removePrice(index)">
                  <TrashIcon
                    class="h-5 w-5 text-black group-hover:text-white"
                    aria-hidden="true"
                  />
                </button>
              </div>
            </div>
            <button class="group flex items-end gap-2 border rounded-lg px-4 py-2 w-fit hover:bg-black hover:text-white" type="button" @click="addPrice">
              <h4 class="text-sm">Nuevo Precio</h4>
              <PlusCircleIcon
                class="h-5 w-5 text-black group-hover:text-white"
                aria-hidden="true"
              />
            </button>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Tags</h3>
              <treeselect v-model="product.tags" :multiple="true" :options="tagsOptions" :errors="errors['tags']"/>
          </div>
          <hr class="my-4">
          <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold">Publicar</h3>
            <CustomInput type="checkbox" class="mb-2" v-model="product.published" :errors="errors['published']" :label="product.published ? 'Publicado' : 'No publicado'"/>
          </div>
        </div>
        <div class="col-span-1 px-4 pt-5 pb-4">
          <image-preview v-model="product.images"
                          :images="product.images"
                          v-model:deleted-images="product.deleted_images"
                          v-model:image-positions="product.image_positions"/>
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
        <router-link :to="{name: 'app.products'}"
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
// import the component
import Treeselect from 'vue3-treeselect'
// import the styles
import 'vue3-treeselect/dist/vue3-treeselect.css'
import axiosClient from "../../axios.js";

const route = useRoute()
const router = useRouter()

const product = ref({
  id: null,
  title: null,
  images: [],
  deleted_images: [],
  image_positions: {},
  description: '',
  link: '',
  prices: [{ number: '', size: '' }],
  published: false,
  categories: [],
  alergens: [],
  tags:[],
})

console.log(product.prices)
const errors = ref({});

const loading = ref(false);
const categoriesOptions = ref([]);
const alergensOptions = ref([]);
const tagsOptions = ref([]);

const emit = defineEmits(['update:modelValue', 'close'])

onMounted(() => {
  if (route.params.id) {
    loading.value = true
    store.dispatch('getProduct', route.params.id)
      .then((response) => {
        loading.value = false;
        product.value = response.data;
        if (!product.value.prices.length) {
          product.value.prices.push({ number: '', size: '' }); // Asegúrate de tener un campo vacío si no hay precios
        }
      })
  }
  
  axiosClient.get('/categories/tree')
  .then(result => {
    categoriesOptions.value = result.data
  })
  axiosClient.get('/alergens/tree')
  .then(result => {
    alergensOptions.value = result.data
  })
  axiosClient.get('/tags/tree')
  .then(result => {
    tagsOptions.value = result.data.sort((a, b) => a.label.localeCompare(b.label));
  })

})

function addPrice() {
  product.value.prices.push({ number: '', size: '' });
}

function removePrice(index) {
  product.value.prices.splice(index, 1);
  if (product.value.prices.length === 0) {
    addPrice(); // Asegúrate de que siempre haya al menos un campo
    }
}

function onSubmit($event, close = false) {
  loading.value = true
  errors.value = {};
  product.value.prices = product.value.prices.filter(
    (price) => price.number !== '' && price.size !== ''
  );
  if (product.value.id) {
    store.dispatch('updateProduct', product.value)
      .then(response => {
        loading.value = false;
        if (response.status === 200) {
          product.value = response.data
          store.commit('showToast', 'Product was successfully updated');
          store.dispatch('getProducts')
          if (close) {
            router.push({name: 'app.products'})
          }
        }
      })
      .catch(err => {
        loading.value = false;
        errors.value = err.response.data.errors
      })
  } else {
    store.dispatch('createProduct', product.value)
      .then(response => {
        loading.value = false;
        if (response.status === 201) {
          product.value = response.data
          store.commit('showToast', 'Product was successfully created');
          store.dispatch('getProducts')
          if (close) {
            router.push({name: 'app.products'})
          } else {
            product.value = response.data
            router.push({name: 'app.products.edit', params: {id: response.data.id}})
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
  