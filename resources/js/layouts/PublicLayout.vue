<template>
  <div id="public-layout">
    <main>
      <app-header :nav-links="navLinks" :is-logged-in="isLoggedIn" />
      <router-view />
    </main>
    <app-footer />
  </div>
</template>

<script setup>
import { computed } from 'vue';
import AppHeader from '../components/AppHeader.vue';
import AppFooter from '../components/AppFooter.vue';

const isLoggedIn = computed(() => !!window.User);

// In a real SPA, we would get this from a UserStore
const navLinks = computed(() => {
  const links = [
    { label: 'Home', url: '/' }
  ];
  
  if (isLoggedIn.value) {
    links.push({ label: 'Profile', url: '/user' });
    links.push({ label: 'Track Order', url: '/user/order' });
  } else {
    links.push({ label: 'Sign In', url: '/login' });
    links.push({ label: 'Sign Up', url: '/register', class: 'btn-primary' });
  }
  
  return links;
});
</script>

<style scoped>
/* Scoped styles if needed */
</style>
