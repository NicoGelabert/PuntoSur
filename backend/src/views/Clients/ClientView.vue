<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="flex items-center justify-between mb-3">
      <h1 v-if="!loading" class="text-3xl font-semibold">
        {{ client.id ? `Update client: "${client.full_name}"` : 'Create new Client' }}
      </h1>
    </div>
    <div class="bg-white rounded-lg shadow animate-fade-in-down">
      <Spinner v-if="loading"
                class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center z-50"/>
      <form v-if="!loading" @submit.prevent="onSubmit">
        <div class="grid grid-cols-1 md:grid-cols-3">
          <div class="col-span-2 px-4 pt-5 pb-4">
            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-bold">Client Full Name</h3>
                <CustomInput class="mb-2" v-model="client.full_name" label="Client Name" :errors="errors['full_name']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-bold">Age</h3>
                <CustomInput type="number" class="mb-2" v-model="client.age" label="Client Age" :errors="errors['age']"/>
            </div>
            
            <hr class="my-4">
            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-bold">Phone number</h3>
                <CustomInput type="number" class="mb-2" v-model="client.phone_number" label="Phone number" :errors="errors['phone_number']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Emergency phone number</h3>
              <CustomInput type="number" class="mb-2" v-model="client.emergency_phone_number" label="Emergency phone number" :errors="errors['emergency_phone_number']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Town</h3>
              <CustomInput class="mb-2" v-model="client.town" label="Town" :errors="errors['town']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Occupancy</h3>
              <CustomInput class="mb-2" v-model="client.occupancy" label="Occupancy" :errors="errors['occupancy']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">email</h3>
              <CustomInput class="mb-2" v-model="client.email" label="email" :errors="errors['email']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Producto</h3>
              <CustomInput class="mb-2" v-model="client.producto" label="Producto" :errors="errors['producto']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Sore</h3>
              <CustomInput class="mb-2" v-model="client.sore" label="Sore" :errors="errors['sore']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Medication</h3>
              <CustomInput class="mb-2" v-model="client.medication" label="Medication" :errors="errors['medication']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Allergies</h3>
              <CustomInput class="mb-2" v-model="client.allergies" label="Allergies" :errors="errors['allergies']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Medical Background</h3>
              <CustomInput class="mb-2" v-model="client.medicalBackground" label="Medical Background" :errors="errors['medicalBackground']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Sports</h3>
              <CustomInput class="mb-2" v-model="client.sports" label="Sports" :errors="errors['sports']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Current Diet</h3>
              <CustomInput class="mb-2" v-model="client.currentDiet" label="Current Diet" :errors="errors['currentDiet']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Sleep Patterns</h3>
              <CustomInput class="mb-2" v-model="client.sleepPatterns" label="Sleep Patterns" :errors="errors['sleepPatterns']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">Water Intake</h3>
              <CustomInput class="mb-2" v-model="client.waterIntake" label="Water Intake" :errors="errors['waterIntake']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">pregnancy</h3>
              <CustomInput class="mb-2" v-model="client.pregnancy" label="pregnancy" :errors="errors['pregnancy']"/>
            </div>
            <hr class="my-4">
            <div class="flex flex-col gap-2">
              <h3 class="text-lg font-bold">menopause</h3>
              <CustomInput class="mb-2" v-model="client.menopause" label="menopause" :errors="errors['menopause']"/>
            </div>
          </div>
        </div>
        <footer class="bg-gray-50 rounded-b-lg px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="submit"
                  class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
            Save
          </button>
          <button type="button"
                  @click="onSubmit($event, true)"
                  class="bg-black text-base font-medium text-white border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-black/10 hover:text-black focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-black sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm">
            Save & Close
          </button>
          <router-link :to="{name: 'app.clients'}"
                        class="bg-white text-base font-medium text-gray-700 border rounded-md border-gray-300 shadow-sm w-full inline-flex justify-center mt-3 px-4 py-2 hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 sm:w-auto sm:mt-0 sm:ml-3 sm:text-sm"
                        ref="cancelButtonRef">
            Cancel
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
  
  const client = ref({
    id: null,
    full_name: null,
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
  })
  
  const errors = ref({});
  
  const loading = ref(false);
  const authorsOptions = ref([]);
  
  const emit = defineEmits(['update:modelValue', 'close'])
  
  onMounted(() => {
    if (route.params.id) {
      loading.value = true
      store.dispatch('getClient', route.params.id)
        .then((response) => {
          loading.value = false;
          client.value = response.data.data;
        })
    }
  })
  
  function onSubmit($event, close = false) {
    loading.value = true
    errors.value = {};
    if (client.value.id) {
      store.dispatch('updateClient', client.value)
        .then(response => {
          loading.value = false;
          if (response.status === 200) {
            client.value = response.data.data
            store.commit('showToast', 'Client was successfully updated');
            store.dispatch('getClients')
            if (close) {
              router.push({name: 'app.clients'})
            }
          }
        })
        .catch(err => {
          loading.value = false;
          errors.value = err.response.data.data.errors
        })
    } else {
      store.dispatch('createClient', client.value)
        .then(response => {
          loading.value = false;
          if (response.status === 201) {
            client.value = response.data.data
            store.commit('showToast', 'Client was successfully created');
            store.dispatch('getClients')
            if (close) {
              router.push({name: 'app.clients'})
            } else {
              client.value = response.data.data
              router.push({name: 'app.clients.edit', params: {id: response.data.data.id}})
            }
          }
        })
        .catch(err => {
          loading.value = false;
          errors.value = err.response.data.data.errors
        })
    }
  }
  </script>
    