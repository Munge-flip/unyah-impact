<template>
  <div class="orders-container">
    <!-- Loading State -->
    <div v-if="loading" class="text-center p-10">
      <p>Loading your order history...</p>
    </div>

    <!-- Orders List -->
    <template v-else>
      <div v-for="order in orders" :key="order.id" class="order-card">
        <div class="order-header">
          <div class="order-id">
            <strong>Order #{{ order.id }}</strong>
            <span class="order-date">{{ formatDate(order.created_at) }}</span>
          </div>
          <status-badge :status="order.status"></status-badge>
        </div>

        <div class="order-details">
          <detail-row label="Game" :value="order.game"></detail-row>
          <detail-row label="Service" :value="order.service_type"></detail-row>
          <detail-row label="Amount" :value="order.price" :is-price="true"></detail-row>
        </div>

        <div class="order-actions">
          <a :href="`/user/order/${order.id}`" class="action-btn primary">View</a>
          <a :href="`/user/order/${order.id}/chat`" class="action-btn secondary">
            Chat with Agent
          </a>
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="orders.length === 0" class="order-card" style="text-align: center; color: #888;">
        <p>No orders found. <a href="/" style="color: #667eea;">Book a service now!</a></p>
      </div>
    </template>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  apiUrl: { type: String, default: '/api/v1/orders' }
});

const orders = ref([]);
const loading = ref(true);

async function fetchOrders() {
  try {
    const response = await axios.get(props.apiUrl);
    if (response.data.success) {
      orders.value = response.data.data;
    }
  } catch (error) {
    console.error('Failed to fetch orders:', error);
  } finally {
    loading.value = false;
  }
}

function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
}

onMounted(fetchOrders);
</script>

<style scoped>
.order-card {
  animation: fadeIn 0.5s ease;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>