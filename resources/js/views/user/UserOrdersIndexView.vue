<template>
  <div class="content-section">
    <h1>Order History</h1>
    <order-history-list 
      api-url="/user/api/orders" 
      view-base-url="/user/order"
    ></order-history-list>
  </div>
</template>

<script setup>
import OrderHistoryList from '../../components/OrderHistoryList.vue';
</script>

<style scoped>
/* Inherits from dashboard.css */
</style>
