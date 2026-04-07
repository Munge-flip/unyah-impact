<template>
  <div id="service-layout">
    <app-header :nav-links="navLinks" />

    <div v-if="banner" class="banner">
      <img :src="banner" :alt="title || 'Banner'">
    </div>

    <main class="services-container">
      <aside v-if="hasSidebar" class="sidebar">
        <slot name="sidebar"></slot>
      </aside>

      <section class="content">
        <router-view />
      </section>
    </main>

    <app-footer />
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';

const props = defineProps({
  title: String,
  banner: String,
  hasSidebar: { type: Boolean, default: true }
});

const route = useRoute();

const navLinks = [
  { label: 'Home', url: '/' },
  { label: 'Profile', url: '/user' },
  { label: 'Track Order', url: '/user/order' }
];
</script>

<style scoped>
/* Inherits from services.css */
</style>
