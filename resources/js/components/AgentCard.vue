<template>
  <div class="agent-card">
    <div class="agent-header">
      <div class="agent-avatar">
        {{ initials }}
      </div>
      <div class="agent-info">
        <h3>{{ agent.name }}</h3>
        <p class="agent-id">ID: #{{ agent.id }}</p>
      </div>
      <div class="agent-stats">
        <span class="stat-badge">{{ agent.tasks_count || 0 }} Active Orders</span>
      </div>
    </div>

    <div class="agent-details">
      <div class="detail-item">
        <span>Orders Handling:</span>
        <strong>{{ agent.tasks_count || 0 }}</strong>
      </div>
      <div class="detail-item">
        <span>Status:</span>
        <span class="badge in-progress">Active</span>
      </div>
    </div>

    <div class="agent-actions">
      <a v-if="ordersRoute" :href="ordersRoute" class="btn-secondary">
        View Orders
      </a>
      <a v-if="manageRoute" :href="manageRoute" class="btn-danger">
        Manage
      </a>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  agent: { type: Object, required: true },
  ordersRoute: { type: String, default: '' },
  manageRoute: { type: String, default: '' }
});

const initials = computed(() => {
  if (!props.agent.name) return '??';
  return props.agent.name.substring(0, 2).toUpperCase();
});
</script>

<style scoped>
/* Inheriting from dashboard.css */
</style>