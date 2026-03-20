<template>
  <div class="agent-profile-card">
    <div class="profile-header">
      <div class="avatar">
        <div class="avatar-text">
          {{ initials }}
        </div>
      </div>
      <div class="profile-info">
        <h2>{{ name }}</h2>
        <p class="agent-role">Agent ID: #{{ id }}</p>
      </div>
    </div>

    <div class="performance-stats">
      <div class="stat-item">
        <div class="stat-icon">📦</div>
        <div class="stat-details">
          <p class="stat-label">Orders Handling</p>
          <p class="stat-value">{{ handling }}</p>
        </div>
      </div>
      <div class="stat-item">
        <div class="stat-icon">✅</div>
        <div class="stat-details">
          <p class="stat-label">Completed</p>
          <p class="stat-value">{{ completed }}</p>
        </div>
      </div>
      <div class="stat-item">
        <div class="stat-icon">📊</div>
        <div class="stat-details">
          <p class="stat-label">Completion Rate</p>
          <p class="stat-value">{{ rate }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  name: { type: String, required: true },
  id: { type: [String, Number], required: true },
  handling: { type: [String, Number], default: 0 },
  completed: { type: [String, Number], default: 0 },
  rate: { type: String, default: '0%' }
});

const initials = computed(() => {
  if (!props.name) return '??';
  return props.name.substring(0, 2).toUpperCase();
});
</script>

<style scoped>
/* Inheriting from dashboard.css */
</style>