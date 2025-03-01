<template>
    <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
        <div class="flex flex-col md:flex-row justify-between border-b-2 pb-3 gap-4">
            <div class="flex md:items-center flex-col md:flex-row gap-4">
                <span class="whitespace-nowrap mr-3">Per Page</span>
                <select @change="getClients(null)" v-model="perPage"
                        class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="ml-3">Found {{clients.data.length}} clients</span>
            </div>
            <div>
                <input v-model="search" @change="getProducts(null)"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Type to Search products">
            </div>
        </div>
      
        <table class="table-auto w-full">
            <thead class="hidden md:contents">
                <tr>
                    <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection" @click="sortClients('id')">
                        ID
                    </TableHeaderCell>
                    <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection" @click="sortClients('name')">
                        Name
                    </TableHeaderCell>
                    <TableHeaderCell field="image" :sort-field="sortField" :sort-direction="sortDirection">
                        Image
                    </TableHeaderCell>
                    <TableHeaderCell field="active" :sort-field="sortField" :sort-direction="sortDirection" @click="sortClients('active')">
                        Active
                    </TableHeaderCell>
                    <TableHeaderCell field="parent_id" :sort-field="sortField" :sort-direction="sortDirection" @click="sortClients('parent_id')">
                        Parent
                    </TableHeaderCell>
                    <TableHeaderCell field="created_at" :sort-field="sortField" :sort-direction="sortDirection" @click="sortClients('created_at')">
                        Create Date
                    </TableHeaderCell>
                    <TableHeaderCell field="actions">
                        Actions
                    </TableHeaderCell>
                </tr>
            </thead>
            <tbody v-if="clients.loading || !clients.data.length">
                <tr>
                    <td colspan="7">
                        <Spinner v-if="clients.loading"/>
                        <p v-else class="text-center py-8 text-gray-700">
                            There are no clients
                        </p>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr v-for="(client, index) of clients.data" :key="index">
                    <td class="border-b p-2 ">{{ client.id }}</td>
                    <td class="border-b p-2 ">{{ client.name }}</td>
                    <td class="border-b p-2 hidden md:table-cell">
                        <img v-if="client.image_url" class="w-16 h-16 object-cover" :src="client.image_url" :alt="client.name">
                        <img v-else class="w-16 h-16 object-cover" src="../../assets/noimage.png">
                    </td>
                    <td class="border-b p-2 hidden md:table-cell">{{ client.active ? 'Yes' : 'No' }}</td>
                    <td class="border-b p-2 hidden md:table-cell">{{ client.parent?.name }}</td>
                    <td class="border-b p-2 hidden md:table-cell">{{ client.created_at }}</td>
                    <td class="border-b p-2 ">
                        <ActionMenu
                            :edit="() => editClient(client)"
                            :remove="() => deleteClient(client)"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
  
<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import Spinner from "../../components/core/Spinner.vue";
import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {EllipsisVerticalIcon, PencilSquareIcon, TrashIcon} from '@heroicons/vue/24/solid';
import ClientModal from "./ClientModal.vue";
import ActionMenu from "../../components/core/ActionMenu.vue";

const clients = computed(() => store.state.clients);
const sortField = ref('name');
const sortDirection = ref('asc')

const client = ref({})
const showClientModal = ref(false);

const emit = defineEmits(['clickEdit'])

onMounted(() => {
    getClients();
})

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }

    getClients(link.url)
}

function getClients(url = null) {
    store.dispatch("getClients", {
        url,
        sort_field: sortField.value,
        sort_direction: sortDirection.value
    });
}

function sortClients(field) {
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

    getClients()
}

function showAddNewModal() {
    showClientModal.value = true
}

function deleteClient(client) {
    if (!confirm(`Are you sure you want to delete the client?`)) {
        return
    }
    store.dispatch('deleteClient', client)
    .then(res => {
        store.commit('showToast', 'Client was successfully deleted');
        store.dispatch('getClients')
    })
}

function editClient(c) {
    emit('clickEdit', c)
}
</script>