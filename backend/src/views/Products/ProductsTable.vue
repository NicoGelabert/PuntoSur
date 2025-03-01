<template>
    <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
      <div class="flex flex-col md:flex-row justify-between border-b-2 pb-3 gap-4">
        <div class="flex md:items-center flex-col md:flex-row gap-4">
          <span class="whitespace-nowrap mr-3">Per Page</span>
          <select @change="getProducts(null)" v-model="perPage"
                  class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <span class="ml-3">Found {{ products.total }} treatments</span>
        </div>
        <div>
          <input v-model="search" @change="getProducts(null)"
                 class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                 placeholder="Type to Search treatments">
        </div>
      </div>
  
      <table class="table-auto w-full">
        <thead class="hidden md:contents">
        <tr>
          <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection" @click="sortProducts('id')">
            ID
          </TableHeaderCell>
          <TableHeaderCell field="image" :sort-field="sortField" :sort-direction="sortDirection">
            Image
          </TableHeaderCell>
          <TableHeaderCell field="title" :sort-field="sortField" :sort-direction="sortDirection"
                           @click="sortProducts('title')">
            Title
          </TableHeaderCell>
          <TableHeaderCell field="category" :sort-field="sortField" :sort-direction="sortDirection"
                           @click="sortProducts('category')">
            Categories
          </TableHeaderCell>
          <TableHeaderCell field="updated_at" :sort-field="sortField" :sort-direction="sortDirection"
                           @click="sortProducts('updated_at')">
            Last Updated At
          </TableHeaderCell>
          <TableHeaderCell field="actions">
            Actions
          </TableHeaderCell>
        </tr>
        </thead>
        <tbody v-if="products.loading || !products.data.length">
        <tr>
          <td colspan="6">
            <Spinner v-if="products.loading"/>
            <p v-else class="text-center py-8 text-gray-700">
              There are no products
            </p>
          </td>
        </tr>
        </tbody>
        <tbody v-else>
        <tr v-for="(product, index) of products.data" :key="index">
          <td class="border-b p-2 ">{{ product.id }}</td>
          <td class="border-b p-2 hidden md:table-cell">
            <img v-if="product.image_url" class="w-16 h-16 object-cover" :src="product.image_url" :alt="product.title">
            <img v-else class="w-16 h-16 object-cover" src="../../assets/noimage.png">
          </td>
          <td class="border-b p-2">
            <div class="truncate overflow-hidden text-ellipsis whitespace-nowrap w-[100px]">
              {{ product.title }}
            </div>
          </td>
          <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis  hidden md:table-cell">
            {{ product.categories.map(category => category.name).join(', ') }}
          </td>
          <td class="border-b p-2  hidden md:table-cell">
            {{ product.updated_at }}
          </td>
          <td class="border-b p-2 ">
            <ActionMenu
              :editType="'router-link'"
              :editTo="{ name: 'app.products.edit', params: { id: product.id } }"
              :remove="() => deleteProduct(product)"
            />
          </td>
        </tr>
        </tbody>
      </table>
  
      <div v-if="!products.loading" class="flex flex-col md:flex-row gap-4 justify-between items-center mt-5">
        <div v-if="products.data.length">
          Showing from {{ products.from }} to {{ products.to }}
        </div>
        <nav
          v-if="products.total > products.limit"
          class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
          <a
            v-for="(link, i) of products.links"
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
                i === products.links.length - 1 ? 'rounded-r-md' : '',
                !link.url ? ' bg-gray-100 text-gray-700': '',
                (link.label.includes('Previous') || link.label.includes('Next')) ? 'hidden md:inline' : ''
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
  import {PRODUCTS_PER_PAGE} from "../../constants";
  import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
  import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
  import {EllipsisVerticalIcon, PencilSquareIcon, TrashIcon} from '@heroicons/vue/24/solid';
  import ActionMenu from "../../components/core/ActionMenu.vue";
  
  const perPage = ref(PRODUCTS_PER_PAGE);
  const search = ref('');
  const products = computed(() => store.state.products);
  const sortField = ref('updated_at');
  const sortDirection = ref('desc')
  
  const product = ref({})
  
  onMounted(() => {
    getProducts();
  })
  
  function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
      return;
    }
  
    getProducts(link.url)
  }
  
  function getProducts(url = null) {
    store.dispatch("getProducts", {
      url,
      search: search.value,
      per_page: perPage.value,
      sort_field: sortField.value,
      sort_direction: sortDirection.value
    });
  }
  
  function sortProducts(field) {
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
  
    getProducts()
  }
  
  function deleteProduct(product) {
    if (!confirm(`Are you sure you want to delete the product?`)) {
      return
    }
    store.dispatch('deleteProduct', product.id)
      .then(res => {
        store.commit('showToast', 'Product was successfully deleted');
        store.dispatch('getProducts')
      })
  }
  
  </script>
  