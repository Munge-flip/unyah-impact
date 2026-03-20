<template>
  <div class="orders-container">
    <!-- Loading State -->
    <div v-if="loading" class="text-center p-10">
      <p>Loading orders...</p>
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
          <detail-row :label="isAgent ? 'Customer' : 'Amount'">
            <span v-if="!isAgent" class="price">₱{{ formatPrice(order.price) }}</span>
            <span v-else>{{ order.user?.name || 'Unknown' }}</span>
          </detail-row>
        </div>

        <div class="order-actions">
          <a :href="`${viewBaseUrl}/${order.id}`" class="action-btn primary">View</a>
          <a :href="`${viewBaseUrl}/${order.id}/chat`" class="action-btn secondary">
            Chat with {{ isAgent ? 'User' : 'Agent' }}
          </a>
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="orders.length === 0" class="order-card" style="text-align: center; color: #888;">
        <p>No orders found.</p>
      </div>
    </template>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  apiUrl: { type: String, required: true },
  viewBaseUrl: { type: String, default: '/user/order' },
  isAgent: { type: Boolean, default: false }
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

function formatPrice(val) {
  return Number(val).toLocaleString(undefined, { minimumFractionDigits: 2 });
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