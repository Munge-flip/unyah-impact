<template>
  <div class="info-card">
    <div v-if="title || $slots.header || manageRoute" class="card-header">
      <div v-if="$slots.header" style="flex: 1;">
        <slot name="header"></slot>
      </div>
      <h3 v-else>{{ title }}</h3>
      
      <a v-if="manageRoute" :href="manageRoute" class="edit-btn">Manage →</a>
      <slot name="action"></slot>
    </div>
    
    <div :class="{'info-body': useBody}">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  manageRoute: String,
  useBody: {
    type: Boolean,
    default: false
  }
});
</script>

<style scoped>
/* Inheriting from dashboard.css */
</style>