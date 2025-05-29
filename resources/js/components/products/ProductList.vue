<template>
  <!-- INICIO CONTENEDOR FILTROS Y LISTADO DE PRODUCTOS -->
  <div class="flex flex-col gap-8 lg:flex-row">
    <!-- INICIO BOTÓN PARA ABRIR MODAL EN MOBILE Y TABLET  -->
    <button v-if="!isDesktop" @click="showModal = true" class="btn btn-secondary btn-filtro flex gap-4 items-center w-fit">
      <p>Filtrar por</p>
      <FilterIcon class="w-4 h-4 fill-gray_600" />
    </button>
    <!-- FIN BOTÓN PARA ABRIR MODAL EN MOBILE Y TABLET  -->

    <!-- INCIO MODAL CON FILTROS EN MOBILE Y TABLET -->
    <div class="modal-wrapper">
      <transition name="overlay-fade">
        <div v-if="showModal" class="modal-overlay pointer-events-auto" @click="showModal = false"></div>
      </transition>
      <transition name="modal-slide-up">
        <div v-if="showModal" class="modal-content">
          <div class="flex justify-between items-center">
            <h2>Filtros</h2>
            <button @click="showModal = false" class="close-btn">✖</button>
          </div>
          
          <!-- Categorías dentro del modal -->
          <div v-if="categories && categories.length > 0" class="filter_categories">
            <h4>Categorías</h4>
            <ul>
              <li 
                @click="changeCategory('all')" 
                :class="{ active: selectedCategory === 'all' }"
                class="cursor-pointer"
              >
                Todos
              </li>
              <li 
                v-for="category in categories" 
                :key="category.id" 
                @click="changeCategory(category.id)"
                :class="{ active: selectedCategory === category.id }"
                class="cursor-pointer flex items-center gap-2"
              >
                <img 
                  :src="category.image || '/images/default-product.jpg'" 
                  alt="Imagen del producto" class="w-4 h-auto opacity-50"
                />
                {{ category.name }}
              </li>
            </ul>
          </div>
  
          <!-- Etiquetas dentro del modal -->
          <div v-if="tags && tags.length > 0" class="filter_tags">
            <h4>Etiquetas</h4>
            <ul>
              <li 
                @click="toggleTag('all')" 
                :class="{ active: selectedTags.length === tags.length }"
                class="badge"
              >
                <span>Todos</span>
              </li>
              <li 
                v-for="tag in tags" 
                :key="tag.id" 
                @click="toggleTag(tag.id)"
                :class="{ active: selectedTags.includes(tag.id) }"
                class="badge"
              >
                <span>{{ tag.name }}</span>
              </li>
            </ul>
          </div>
        </div>
      </transition>
    </div>
      
    <!-- FIN MODAL CON FILTROS EN MOBILE Y TABLET -->

    <!-- INICIO FILTROS EN DESKTOP -->
    <div v-if="isDesktop" class="lg:w-1/4 flex flex-col gap-12 bg-white p-4 h-fit rounded-lg">
      <div v-if="categories && categories.length > 0" class="filter_categories">
        <h4>Categorías</h4>
        <ul>
          <li 
            @click="changeCategory('all')" 
            :class="{ active: selectedCategory === 'all' }"
            class="cursor-pointer"
          >
            Todos
          </li>
          <li 
            v-for="category in categories" 
            :key="category.id" 
            @click="changeCategory(category.id)"
            :class="{ active: selectedCategory === category.id }"
            class="cursor-pointer flex items-center gap-2"
          >
            <img 
              :src="category.image || '/images/default-product.jpg'" 
              alt="Imagen del producto" class="w-4 h-auto opacity-50"
            />
            {{ category.name }}
          </li>
        </ul>
      </div>

      <div v-if="tags && tags.length > 0" class="filter_tags">
        <h4>Etiquetas</h4>
        <ul>
          <li 
            @click="toggleTag('all')" 
            :class="{ active: selectedTags.length === tags.length }"
            class="badge"
          >
            <span>Todos</span>
          </li>
          <li 
            v-for="tag in tags" 
            :key="tag.id" 
            @click="toggleTag(tag.id)"
            :class="{ active: selectedTags.includes(tag.id) }"
            class="badge"
          >
            <span>{{ tag.name }}</span>
          </li>
        </ul>
      </div>
    </div>
    <!-- FIN FILTROS EN DESKTOP -->

    <!-- INICIO LISTADO PRODUCTOS -->
    <div v-if="filteredProducts.length > 0" class="product-list">
      <!-- INICIO PRODUCTO -->
      <div v-for="product in filteredProducts" :key="product.id" class="product_card">
        <!-- INICIO IMAGEN PRODUCTO -->
        <div class="relative">
          <img 
            :src="product.images?.[0]?.url || '/images/default-product.jpg'" 
            alt="Imagen del producto" 
          />
          <!-- INICIO IMAGEN CATEGORÍA -->
            <div class="categories_badges relative">
              <div v-for="category in product.categories" :key="category.id" class="category_badge relative w-6 h-6">
                <img :src="category.image" :alt="category.name" class="" :data-tooltip-target="'tooltip-category-' + category.id">
                <!-- INICIO TOOLTIP -->
                <div :id="'tooltip-category-' + category.id" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                  <span class="whitespace-nowrap">{{category.name}}</span>
                  <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <!-- INICIO TOOLTIP -->
              </div>
            </div>
            <!-- FIN IMAGEN CATEGORÍA -->
        </div>
        <!-- FIN IMAGEN PRODUCTO -->
        <!-- INICIO CONTENIDO PRODUCTO -->
        <div class="flex flex-col justify-between flex-1">
          <!-- INICIO PRODUCT NAME, DESCRIPTION -->
          <div class="flex flex-col justify-between flex-1 py-4 px-2 gap-4 border-b">
            <a :href="`/categorias/${product.categories?.[0]?.slug || 'sin-subcategoria'}/${product.slug}`">
              <div class="flex items-center justify-between mb-2">
                <h5 class="w-fit text-base leading-none">{{ product.title }}</h5>
              </div>
              <div>
                  <p v-html="product.description"></p>
              </div>
            </a>
            <!-- INICIO IMAGEN ALÉRGENO -->
            <div>
              <span class="text-[0.6rem] font-extrabold">Contiene:</span>
              <div class="alergen_badges relative">
                <div v-for="alergen in product.alergens" :key="alergen.id" class="alergen_badge relative w-6 h-6">
                  <img :src="alergen.image" :alt="alergen.name" class="" :data-tooltip-target="'tooltip-alergen-' + alergen.id">
                  <!-- INICIO TOOLTIP -->
                  <div :id="'tooltip-alergen-' + alergen.id" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                    <span class="whitespace-nowrap">{{alergen.name}}</span>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                  <!-- INICIO TOOLTIP -->
                </div>
              </div>
            </div>
            <!-- FIN IMAGEN ALÉRGENO -->
          </div>
          <!-- FIN PRODUCT NAME, DESCRIPTION -->
          <!-- INICIO FOOTER DE PRODUCTO -->
          <div class="footer">
            <div class="flex justify-between items-center">
              <div v-for="price in product.prices" :key="price.id"  class="flex items-center gap-2">
                <p class="font-bold">${{ price.number }}</p><p class="capitalize">{{ price.size }}</p>
              </div>
            </div>
          </div>
          <!-- FIN FOOTER DE PRODUCTO -->
        </div>
        <!-- FIN CONTENIDO PRODUCTO -->
      </div>
      <!-- FIN PRODUCTO -->
    </div>
    <!-- FIN LISTADO PRODUCTOS -->

    <!-- INICIO MENSAJE NO HAY PRODUCTOS -->
    <div v-else-if="!loading">
      <p>No hay productos disponibles.</p>
    </div>
    <!-- FIN MENSAJE NO HAY PRODUCTOS -->

    <!-- INICIO SPINNER -->
    <div v-if="loading" class="spinner-overlay">
      <div class="spinner"></div>
    </div>
    <!-- FIN SPINNER -->
  </div>
  <!-- FIN CONTENEDOR FILTROS Y LISTADO DE PRODUCTOS -->
</template>

<script>
import FilterIcon from '../icons/FilterIcon.vue';
import { createPopper } from '@popperjs/core';

export default {
  props: {
    products: {
      type: Array,
      required: true
    },
    categories: {
      type: Array,
      default: () => []
    },
    tags: {
      type: Array,
      default: () => []
    }
  },
  components: {
    FilterIcon,
  },
  data() {
    return {
      selectedCategory: 'all',
      selectedTags: [],
      filteredProducts: [],
      loading: false,
      showModal: false, // Controla la visibilidad del modal en mobile
      isDesktop: window.innerWidth >= 1024, // Detecta si es desktop
      hovered: {},
    };
  },
  computed: {
    isMobileOrTablet() {
      return !this.isDesktop;
    },
  },
  methods: {
    changeCategory(categoryId) {
      this.selectedCategory = categoryId;
      this.filterProducts();
    },
    toggleTag(tagId) {
      if (tagId === 'all') {
        this.selectedTags = this.selectedTags.length === this.tags.length ? [] : this.tags.map(tag => tag.id);
      } else {
        const index = this.selectedTags.indexOf(tagId);
        if (index === -1) {
          this.selectedTags.push(tagId);
        } else {
          this.selectedTags.splice(index, 1);
        }
      }
      this.filterProducts();
    },
    filterProducts() {
      this.loading = true;
      setTimeout(() => {
        this.filteredProducts = this.products.filter(product => {
          let categoryMatch = this.selectedCategory === 'all' || product.categories.some(category => category.id === this.selectedCategory);
          let tagMatch = this.selectedTags.length === 0 || product.tags.some(tag => this.selectedTags.includes(tag.id));
          return categoryMatch && tagMatch;
        });
        this.loading = false;
      }, 500);
    },
    checkScreenSize() {
      this.isDesktop = window.innerWidth >= 1024;
    },
  },
  mounted() {
    this.filteredProducts = [...this.products];
    window.addEventListener('resize', this.checkScreenSize);
    setTimeout(() => {
      initTooltips();
    }, 0);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.checkScreenSize);
  },
};
</script>