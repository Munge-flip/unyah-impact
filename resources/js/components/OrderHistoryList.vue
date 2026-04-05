<template>
  <div class="orders-container">
    <!-- Search Bar -->
    <div class="section-header" style="margin-bottom: 25px;">
      <div style="position: relative; width: 100%; max-width: 400px;">
        <input 
          type="text" 
          v-model="searchQuery" 
          placeholder="Search by ID, Game, or Service..." 
          class="search-input"
          style="width: 100%; padding-left: 45px;"
        >
        <span style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); opacity: 0.5;">🔍</span>
      </div>
      
      <div v-if="searchQuery" class="text-muted" style="margin-top: 10px; font-size: 13px;">
        Found {{ orders.length }} result(s) for "{{ searchQuery }}"
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="text-center p-10">
      <p>Fetching orders...</p>
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
        <p v-if="searchQuery">No orders matching "{{ searchQuery }}"</p>
        <p v-else>No orders found. <a v-if="!isAgent" href="/" style="color: #667eea;">Book a service now!</a></p>
      </div>
    </template>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  apiUrl: { type: String, required: true },
  viewBaseUrl: { type: String, default: '/user/order' },
  isAgent: { type: Boolean, default: false }
});

const orders = ref([]);
const loading = ref(true);
const searchQuery = ref('');
let searchTimeout = null;

async function fetchOrders() {
  loading.value = true;
  try {
    const response = await axios.get(props.apiUrl, {
      params: { search: searchQuery.value }
    });
    if (response.data.success) {
      // API now returns { data: { data: [...], meta: {...} } }
      orders.value = response.data.data;
    }
  } catch (error) {
    console.error('Failed to fetch orders:', error);
  } finally {
    loading.value = false;
  }
}

// Debounced Search Logic
watch(searchQuery, () => {
  if (searchTimeout) clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    fetchOrders();
  }, 300);
});

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
.search-input {
    transition: all 0.3s ease;
}
.search-input:focus {
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
    transform: scale(1.02);
}
</style>