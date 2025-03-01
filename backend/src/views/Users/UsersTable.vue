<template>
  <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
    <div class="flex flex-col md:flex-row justify-between border-b-2 pb-3 gap-4">
      <div class="flex md:items-center flex-col md:flex-row gap-4">
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select @change="getUsers(null)" v-model="perPage"
                class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span class="ml-3">Found {{users.total}} users</span>
      </div>
      <div>
        <input v-model="search" @change="getUsers(null)"
               class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
               placeholder="Type to Search users">
      </div>
    </div>

    <table class="table-auto w-full">
      <thead class="hidden md:contents">
      <tr>
        <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortUsers('id')">
          ID
        </TableHeaderCell>
        <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortUsers('email')">
          Name
        </TableHeaderCell>
        <TableHeaderCell field="email" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortUsers('email')">
          Email
        </TableHeaderCell>
        <TableHeaderCell field="created_at" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortUsers('created_at')">
          Create Date
        </TableHeaderCell>
        <TableHeaderCell field="actions">
          Actions
        </TableHeaderCell>
      </tr>
      </thead>
      <tbody v-if="users.loading || !users.data.length">
      <tr>
        <td colspan="6">
          <Spinner v-if="users.loading"/>
          <p v-else class="text-center py-8 text-gray-700">
            There are no users
          </p>
        </td>
      </tr>
      </tbody>
      <tbody v-else>
      <tr v-for="(user) of users.data" :key="user">
        <td class="border-b p-2 ">{{ user.id }}</td>
        <td class="border-b p-2 ">
         {{ user.name }}
        </td>
        <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis hidden md:table-cell">
          {{ user.email }}
        </td>
        <td class="border-b p-2 hidden md:table-cell">
          {{ user.created_at }}
        </td>
        <td class="border-b p-2 ">
          <ActionMenu :edit="() => editUser(user)" :remove="() => deleteUser(user)" />
        </td>
      </tr>
      </tbody>
    </table>

    <div v-if="!users.loading" class="flex justify-between items-center mt-5">
      <div v-if="users.data.length">
        Showing from {{ users.from }} to {{ users.to }}
      </div>
      <nav
        v-if="users.total > users.limit"
        class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
        aria-label="Pagination"
      >
        <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
        <a
          v-for="(link, i) of users.links"
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
              i === users.links.length - 1 ? 'rounded-r-md' : '',
              !link.url ? ' bg-gray-100 text-gray-700': ''
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
import {USERS_PER_PAGE} from "../../constants";
import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {EllipsisVerticalIcon, PencilSquareIcon, TrashIcon} from '@heroicons/vue/24/solid';
import UserModal from "./UserModal.vue";
import ActionMenu from "../../components/core/ActionMenu.vue";

const perPage = ref(USERS_PER_PAGE);
const search = ref('');
const users = computed(() => store.state.users);
const sortField = ref('updated_at');
const sortDirection = ref('desc')

const user = ref({})
const showUserModal = ref(false);

const emit = defineEmits(['clickEdit'])

onMounted(() => {
  getUsers();
})

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  getUsers(link.url)
}

function getUsers(url = null) {
  store.dispatch("getUsers", {
    url,
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value
  });
}

function sortUsers(field) {
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

  getUsers()
}

function showAddNewModal() {
  showUserModal.value = true
}

function deleteUser(user) {
  if (!confirm(`Are you sure you want to delete the user?`)) {
    return
  }
  store.dispatch('deleteUser', user.id)
    .then(res => {
      // TODO Show notification
      store.dispatch('getUsers')
    })
}

function editUser(p) {
  emit('clickEdit', p)
}
</script>

<style scoped>

</style>
