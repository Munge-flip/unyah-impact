<template>
  <div class="profile-card">
    <div class="profile-header">
      <div class="avatar">
        <img :src="avatarUrl" alt="User Avatar">
      </div>
      <div class="profile-info">
        <h2>{{ name }}</h2>
        <p class="user-status">{{ formattedRole }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  name: { type: String, required: true },
  role: { type: String, required: true },
  avatar: { type: String, default: '' },
  defaultAvatar: { type: String, default: '/img/weblogo.png' }
});

const avatarUrl = computed(() => props.avatar ? props.avatar : props.defaultAvatar);
const formattedRole = computed(() => {
  if (!props.role) return '';
  return props.role.charAt(0).toUpperCase() + props.role.slice(1);
});
</script>

<style scoped>
/* Inheriting from dashboard.css */
</style>