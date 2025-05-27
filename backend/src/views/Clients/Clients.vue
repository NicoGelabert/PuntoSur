<template>
    <div class="flex flex-col md:flex-row justify-between mb-3 w-full gap-4">
      <h1 class="text-3xl font-semibold">Clientes</h1>
      <button type="button"
              @click="showAddNewModal()"
              class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:text-black hover:bg-white focus:outline-none text-center"
      >
        Nuevo Cliente
      </button>
    </div>
    <ClientsTable @clickEdit="editClient"/>
    <ClientModal v-model="showClientModal" :client="clientModel" @close="onModalClose"/>
</template>
  
<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import ClientsTable from "./ClientsTable.vue";

const DEFAULT_CLIENT = {
    id: '',
    full_name: '',
    slug: '',
    age: '',
    phone_number: '',
    emergency_phone_number: '',
    town: '',
    occupancy: '',
    email: '',
    producto: '',
    sore: '',
    medication: '',
    allergies: '',
    medicalBackground: '',
    sports: '',
    currentDiet: '',
    sleepPatterns: '',
    waterIntake: '',
    pregnancy: '',
    menopause: '',
    signed: '',
}

const clients = computed(() => store.state.clients);
console.log(clients)
const clientModel = ref({...DEFAULT_CLIENT})
const showClientModal = ref(false);

function showAddNewModal() {
    showClientModal.value = true
}

function editClient(c) {
    clientModel.value = c;
    showAddNewModal();
}

function onModalClose() {
    clientModel.value = {...DEFAULT_CLIENT}
}
</script>
  