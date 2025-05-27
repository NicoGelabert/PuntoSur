<template>
    <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
      <div class="flex flex-col md:flex-row justify-between border-b-2 pb-3 gap-4">
        <div class="flex md:items-center flex-col md:flex-row gap-4">
          <span class="whitespace-nowrap mr-3">Por Página</span>
          <select @change="getHomeHeroBanners(null)" v-model="perPage"
                  class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <span class="ml-3">{{ homeHeroBanners.total }} Imagenes encontradas</span>
        </div>
        <div>
          <input v-model="search" @change="getHomeHeroBanners(null)"
                 class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                 placeholder="Buscar Imágenes">
        </div>
      </div>
  
      <table class="table-auto w-full">
        <thead class="hidden md:contents">
        <tr>
          <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection" @click="sortHomeHeroBanners('id')">
            ID
          </TableHeaderCell>
          <TableHeaderCell field="image" :sort-field="sortField" :sort-direction="sortDirection">
            Imagen
          </TableHeaderCell>
          <TableHeaderCell field="title" :sort-field="sortField" :sort-direction="sortDirection"
                           @click="sortHomeHeroBanners('headline')">
            Titular
          </TableHeaderCell>
          <TableHeaderCell field="updated_at" :sort-field="sortField" :sort-direction="sortDirection"
                           @click="sortHomeHeroBanners('updated_at')">
            Última edición
          </TableHeaderCell>
          <TableHeaderCell field="actions">
            Acciones
          </TableHeaderCell>
        </tr>
        </thead>
        <tbody v-if="homeHeroBanners.loading || !homeHeroBanners.data.length">
        <tr>
          <td colspan="6">
            <Spinner v-if="homeHeroBanners.loading"/>
            <p v-else class="text-center py-8 text-gray-700">
              No se encontraron imágenes
            </p>
          </td>
        </tr>
        </tbody>
        <tbody v-else>
        <tr v-for="(homeHeroBanner, index) of homeHeroBanners.data" :key="index">
          <td class="border-b p-2 ">{{ homeHeroBanner.id }}</td>
          <td class="border-b p-2 hidden md:table-cell">
            <img v-if="homeHeroBanner.image_url" class="w-16 h-16 object-cover" :src="homeHeroBanner.image_url" :alt="homeHeroBanner.headline">
            <img v-else class="w-16 h-16 object-cover" src="../../assets/noimage.png">
          </td>
          <td class="border-b p-2">
            <div class="truncate overflow-hidden text-ellipsis whitespace-nowrap">
              {{ homeHeroBanner.headline }}
            </div>
          </td>
          <td class="border-b p-2  hidden md:table-cell">
            {{ homeHeroBanner.updated_at }}
          </td>
          <td class="border-b p-2 ">
            <ActionMenu
              :editType="'router-link'"
              :editTo="{ name: 'app.homeherobanners.edit', params: { id: homeHeroBanner.id } }"
              :remove="() => deleteHomeHeroBanner(homeHeroBanner)"
            />
          </td>
        </tr>
        </tbody>
      </table>
  
      <div v-if="!homeHeroBanners.loading" class="flex flex-col md:flex-row gap-4 justify-between items-center mt-5">
        <div v-if="homeHeroBanners.data.length">
          Mostrando desde {{ homeHeroBanners.from }} hasta {{ homeHeroBanners.to }}
        </div>
        <nav
          v-if="homeHeroBanners.total > homeHeroBanners.limit"
          class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
          <a
            v-for="(link, i) of homeHeroBanners.links"
            :key="i"
            :disabled="!link.url"
            href="#"
            @click="getForPage($event, link)"
            aria-current="page"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
            :class="[
                link.active
                  ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                  : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                i === 0 ? 'rounded-l-md' : '',
                i === homeHeroBanners.links.length - 1 ? 'rounded-r-md' : '',
                !link.url ? ' bg-gray-100 text-gray-700': '',
                (link.label.includes('Anterior') || link.label.includes('Próxima')) ? 'hidden md:inline' : ''
              ]"
            v-html="link.label"
          >
          </a>
        </nav>
      </div>
    </div>
  </template>
  
  <script setup>
  import {computed, onMounted, ref} from "vue";
  import store from "../../store";
  import Spinner from "../../components/core/Spinner.vue";
  import {HOMEHEROBANNERS_PER_PAGE} from "../../constants";
  import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
  import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
  import {EllipsisVerticalIcon, PencilSquareIcon, TrashIcon} from '@heroicons/vue/24/solid';
  import ActionMenu from "../../components/core/ActionMenu.vue";
  
  const perPage = ref(HOMEHEROBANNERS_PER_PAGE);
  const search = ref('');
  const homeHeroBanners = computed(() => store.state.homeHeroBanners);
  const sortField = ref('updated_at');
  const sortDirection = ref('desc')
  
  const homeHeroBanner = ref({})
  
  onMounted(() => {
    getHomeHeroBanners();
  })
  
  function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
      return;
    }
  
    getHomeHeroBanners(link.url)
  }
  
  function getHomeHeroBanners(url = null) {
    store.dispatch("getHomeHeroBanners", {
      url,
      search: search.value,
      per_page: perPage.value,
      sort_field: sortField.value,
      sort_direction: sortDirection.value
    });
  }
  
  function sortHomeHeroBanners(field) {
    if (field === sortField.value) {
      if (sortDirection.value === 'desc') {
        sortDirection.value = 'asc'
      } else {
        sortDirection.value = 'desc'
      }
    } else {
      sortField.value = field;
      sortDirection.value = 'asc'
    }
  
    getHomeHeroBanners()
  }
  
  function deleteHomeHeroBanner(homeHeroBanner) {
    if (!confirm(`Seguro quiere eliminar el banner?`)) {
      return
    }
    store.dispatch('deleteHomeHeroBanner', homeHeroBanner.id)
      .then(res => {
        store.commit('showToast', 'El banner se eliminó con éxito');
        store.dispatch('getHomeHeroBanners')
      })
  }
  
  </script>
  