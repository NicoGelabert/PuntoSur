<template>

    <div
      :class="[
        toggleIconLeft ? 'w-[25%] min-w-[200px]' : 'w-[60px]',
        'pt-8 pl-2 md:pl-4 transition-all duration-300 ease-in-out min-w-[60px]'
      ]"
      id="sideBarContainer"
    >
        <button id="toggleIconButton" @click="emit('toggle-sidebar', toggleChevronLeftIcon()) " class="flex items-center justify-center rounded transition-colors w-8 h-8 mr-2 mb-8 text-white bg-black hover:text-black hover:bg-white">
            <div :class="[toggleIconLeft ? 'iconOpen' : 'iconClosed']" >
                <ChevronLeftIcon class="rotate-180 md:rotate-0 w-6"/>
            </div>
        </button>
        <div v-for="item in menuItems" :key="item.name || item.type" class="w-full">
          <div
            v-if="item.type === 'divider'"
            class="w-full border-t border-gray-300 my-3"
          ></div>
          <router-link v-else :to="{ name: item.route }"
              class="flex items-center justify-between px-2 py-1 w-full rounded transition-colors duration-200 hover:bg-white">
              <span class="text-sm whitespace-nowrap overflow-hidden transition-all duration-200"
                    :class="toggleIconLeft ? 'opacity-100 ml-2' : 'opacity-0 w-0 ml-0'">
                  {{ item.label }}
              </span>
              <span class="mr-2">
                  <component :is="item.icon" class="w-5" />
              </span>
          </router-link>
        </div>
    </div>
  
</template>

<script setup>

import { 
    ArchiveBoxIcon,
    BuildingStorefrontIcon,
    ChevronLeftIcon,
    FingerPrintIcon,
    IdentificationIcon,
    MegaphoneIcon,
    NewspaperIcon,
    PhotoIcon,
    TrophyIcon,
    UsersIcon
} from '@heroicons/vue/24/outline'
import {ref} from "vue";

const emit = defineEmits(['toggle-sidebar'])

const toggleIconLeft = ref(true);
const toggleChevronLeftIcon = () => {
  toggleIconLeft.value = !toggleIconLeft.value;
}

// Lista de ítems del menú (más organizado)
const menuItems = ref([
    { name: 'dashboard', label: 'Panel Principal', route: 'app.dashboard', icon: BuildingStorefrontIcon },
    { name: 'homeherobanners', label: 'Home Hero Banner', route: 'app.homeherobanners', icon: PhotoIcon },
    { type: 'divider' },
    { name: 'categories', label: 'Categorías', route: 'app.categories', icon: MegaphoneIcon },
    { name: 'products', label: 'Productos', route: 'app.products', icon: ArchiveBoxIcon },
    { type: 'divider' },
    { name: 'articles', label: 'Novedades', route: 'app.articles', icon: NewspaperIcon },
    { name: 'authors', label: 'Autores', route: 'app.authors', icon: IdentificationIcon },
    { type: 'divider' },
    { name: 'clients', label: 'Clientes', route: 'app.clients', icon: TrophyIcon },
    { name: 'users', label: 'Usuarios', route: 'app.users', icon: UsersIcon },
]);

</script>

<style scoped lang="scss">

#sideBarContainer {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 0.25rem;
  a {
    width: 100%;
    display: flex;
    align-items: center;
  }
}
.iconOpen{
  transform: rotate(0);
  transition: transform 0.25s cubic-bezier(0.79, 0.33, 0.14, 0.53);
}
.iconClosed{
  transform: rotate(180deg);
  transition: transform 0.25s cubic-bezier(0.79, 0.33, 0.14, 0.53);
}
</style>