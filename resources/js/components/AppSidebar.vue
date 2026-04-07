<template>
  <aside class="sidebar">
    <div class="sidebar-menu">
      <router-link 
        v-for="item in menuItems" 
        :key="item.route" 
        :to="item.route"
        class="menu-btn"
        active-class="active"
      >
        <span v-html="item.icon"></span>
        {{ item.label }}
      </router-link>
    </div>
  </aside>
</template>

<script setup>
const props = defineProps({
  menuItems: {
    type: Array,
    required: true,
    // Expected structure: { label: 'Home', route: '/', icon: '<svg>...' }
  }
});
</script>

<style scoped>
/* Inherits from dashboard.css */
</style>
