<template>
  <div class="content-section">
    <!-- Header with Search -->
    <div class="section-header">
      <h1>Orders Management</h1>
      <div style="position: relative; width: 300px;">
        <input 
          type="text" 
          v-model="searchQuery" 
          placeholder="Search orders..." 
          class="search-input"
          style="width: 100%;"
        >
      </div>
    </div>

    <!-- Data Table -->
    <div class="table-container">
      <table class="data-table">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Game</th>
            <th>Service</th>
            <th>Customer</th>
            <th>Agent</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Price</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="loading" class="empty-state-row">
            <td colspan="10">Loading orders...</td>
          </tr>
          <template v-else>
            <tr v-for="order in orders" :key="order.id">
              <td>#{{ order.id }}</td>
              <td>{{ order.game }}</td>
              <td>{{ order.service_type }}</td>
              <td>{{ order.user?.name || 'Unknown' }}</td>
              <td :class="{ 'text-unassigned': !order.agent }">
                {{ order.agent?.name || 'Unassigned' }}
              </td>
              <td>
                <status-badge :status="order.payment_status" type="payment"></status-badge>
                <div class="payment-meta">{{ order.payment_method }}</div>
              </td>
              <td>
                <status-badge :status="order.status"></status-badge>
              </td>
              <td>₱{{ formatPrice(order.price) }}</td>
              <td>{{ formatDate(order.created_at) }}</td>
              <td>
                <a :href="`/admin/order/${order.id}`" class="action-link">View</a>
                <button @click="deleteOrder(order.id)" class="action-link delete">Delete</button>
              </td>
            </tr>
            <tr v-if="orders.length === 0" class="empty-state-row">
              <td colspan="10">No orders found.</td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div v-if="pagination.last_page > 1" class="pagination-wrapper">
      <nav class="pagination">
        <button 
          @click="changePage(pagination.current_page - 1)" 
          :disabled="pagination.current_page === 1"
          class="btn-secondary btn-sm mr-2"
        >
          Previous
        </button>
        
        <span class="p-2">Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>

        <button 
          @click="changePage(pagination.current_page + 1)" 
          :disabled="pagination.current_page === pagination.last_page"
          class="btn-secondary btn-sm ml-2"
        >
          Next
        </button>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  apiUrl: { type: String, required: true }
});

const orders = ref([]);
const loading = ref(true);
const searchQuery = ref('');
const pagination = ref({
  current_page: 1,
  last_page: 1,
  total: 0
});
let searchTimeout = null;

async function fetchOrders(page = 1) {
  loading.value = true;
  try {
    const response = await axios.get(props.apiUrl, {
      params: { 
        search: searchQuery.value,
        page: page 
      }
    });
    if (response.data.success) {
      orders.value = response.data.data;
      pagination.value = response.data.meta;
    }
  } catch (error) {
    console.error('Failed to fetch orders:', error);
  } finally {
    loading.value = false;
  }
}

function changePage(page) {
  if (page >= 1 && page <= pagination.value.last_page) {
    fetchOrders(page);
  }
}

async function deleteOrder(id) {
  if (!confirm('Are you sure you want to delete this order?')) return;
  
  try {
    const response = await axios.delete(`${props.apiUrl}/${id}`);
    if (response.data.success) {
      fetchOrders(pagination.value.current_page);
    }
  } catch (error) {
    alert('Failed to delete order. ' + (error.response?.data?.message || ''));
  }
}

// Search with debounce
watch(searchQuery, () => {
  if (searchTimeout) clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    fetchOrders(1); // Reset to page 1 on search
  }, 300);
});

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString(undefined, {
    year: 'numeric', month: 'short', day: 'numeric'
  });
}

function formatPrice(val) {
  return Number(val).toLocaleString(undefined, { minimumFractionDigits: 2 });
}

onMounted(() => fetchOrders());
</script>

<style scoped>
.mr-2 { margin-right: 0.5rem; }
.ml-2 { margin-left: 0.5rem; }
.pagination { display: flex; align-items: center; justify-content: center; }
button:disabled { opacity: 0.5; cursor: not-allowed; }
</style>