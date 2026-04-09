<template>
  <div v-if="orderData" class="order-details-container">
    <div class="section-header">
      <h1>Order Details</h1>
      <router-link to="/admin/order" class="action-link">← Back to Orders</router-link>
    </div>

    <!-- Status Card -->
    <admin-card>
      <template #header>
        <div>
          <h3 style="margin: 0; font-size: 18px; color: #333;">Order #{{ orderData.id }}</h3>
          <span class="order-date">{{ formatDate(orderData.created_at) }}</span>
        </div>
      </template>
      <template #action>
        <status-badge :status="orderData.status"></status-badge>
      </template>
    </admin-card>

    <!-- Service Details -->
    <admin-card title="Service Details">
      <detail-row label="Game" :value="orderData.game"></detail-row>
      <detail-row label="Category" :value="orderData.service_category"></detail-row>
      <detail-row label="Service Type" :value="orderData.service_type"></detail-row>
      <detail-row label="Customer">
        <strong>{{ orderData.user?.name || 'Unknown' }} <span class="user-id-sub">(ID: #{{ orderData.user_id }})</span></strong>
      </detail-row>
      <detail-row label="Amount Paid" :value="orderData.price" :is-price="true"></detail-row>
    </admin-card>

    <!-- Assignment Card -->
    <admin-card title="Assignment">
      <detail-row label="Current Agent" :value="orderData.agent?.name || 'Unassigned'"></detail-row>

      <div class="assignment-section">
        <div class="form-group">
          <label>Assign to Agent:</label>
          <div class="assignment-row">
            <select v-model="selectedAgentId" class="search-input assignment-select">
              <option value="" disabled>Select an Agent</option>
              <option v-for="agent in agents" :key="agent.id" :value="agent.id">
                {{ agent.name }}
              </option>
            </select>
            <button @click="assignAgent" class="btn-primary" :disabled="processingAssignment">
              {{ processingAssignment ? '...' : 'Assign' }}
            </button>
          </div>
        </div>
      </div>

      <div v-if="orderData.status !== 'completed'" class="mt-15">
        <button @click="markComplete" class="action-btn success w-100" :disabled="processingStatus">
          {{ processingStatus ? 'Updating...' : 'Mark as Complete' }}
        </button>
      </div>
    </admin-card>

    <!-- Timeline -->
    <admin-card title="Timeline">
      <detail-row label="Order Placed" :value="formatDate(orderData.created_at)"></detail-row>
      <detail-row label="Status">
        <strong v-if="orderData.status === 'completed'" style="color: #0f5132;">
          Completed on {{ formatDate(orderData.updated_at) }}
        </strong>
        <span v-else class="status-text-pending">In Progress...</span>
      </detail-row>
    </admin-card>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  initialOrder: { type: Object, required: true },
  agents: { type: Array, default: () => [] },
  apiUrl: { type: String, required: true }
});

const orderData = ref(props.initialOrder);
const selectedAgentId = ref(props.initialOrder.agent_id || '');
const processingAssignment = ref(false);
const processingStatus = ref(false);

async function assignAgent() {
  if (!selectedAgentId.value) return;
  processingAssignment.value = true;
  
  try {
    const response = await axios.patch(`${props.apiUrl}/${orderData.value.id}`, {
      agent_id: selectedAgentId.value,
      status: 'in-progress'
    });
    
    if (response.data.success) {
      orderData.value = response.data.data;
      alert('Agent assigned successfully!');
    }
  } catch (error) {
    alert('Error: ' + (error.response?.data?.message || 'Failed to assign agent.'));
  } finally {
    processingAssignment.value = false;
  }
}

async function markComplete() {
  if (!confirm('Mark this order as complete?')) return;
  processingStatus.value = true;
  
  try {
    const response = await axios.patch(`${props.apiUrl}/${orderData.value.id}`, {
      status: 'completed'
    });
    
    if (response.data.success) {
      orderData.value = response.data.data;
    }
  } catch (error) {
    alert('Error: ' + (error.response?.data?.message || 'Failed to update status.'));
  } finally {
    processingStatus.value = false;
  }
}

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString(undefined, {
    year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit'
  });
}
</script>

<style scoped>
.user-id-sub { color: #888; font-weight: normal; font-size: 13px; }
.status-text-pending { color: #888; font-style: italic; }
.assignment-section { margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; }
.assignment-row { display: flex; gap: 10px; }
.assignment-select { flex: 1; }
.mt-15 { margin-top: 15px; }
</style>