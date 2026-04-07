<template>
  <div class="content-section">
    <h1>My Account</h1>

    <profile-card 
      v-if="user"
      :name="user.name" 
      :role="user.role" 
      :avatar="user.avatar ? `/${user.avatar}` : ''"
    ></profile-card>

    <info-card title="Personal Information" manage-route="/user/edit">
      <div v-if="user" class="info-grid">
        <div class="info-item">
          <label>Name</label> <p>{{ user.name }}</p>
        </div>
        <div class="info-item">
          <label>Email Address</label>
          <p>{{ user.email }}</p>
        </div>
        <div class="info-item">
          <label>Mobile Number</label>
          <p>{{ user.phone || 'Not set' }}</p>
        </div>
      </div>
    </info-card>

    <info-card title="Password and Security" manage-route="/user/update">
      <div v-if="user" class="info-grid">
        <div class="info-item">
          <label>Password</label>
          <p>••••••••</p>
        </div>
        <div class="info-item">
          <label>Account Created</label>
          <p>{{ formatDate(user.created_at) }}</p>
        </div>
      </div>
    </info-card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ProfileCard from '../../components/ProfileCard.vue';
import InfoCard from '../../components/InfoCard.vue';

const user = ref(window.User);

function formatDate(dateString) {
  if (!dateString) return '';
  return new Date(dateString).toLocaleDateString(undefined, {
    year: 'numeric', month: 'short', day: 'numeric'
  });
}

onMounted(() => {
  // Sync with global state if it changed
  user.value = window.User;
});
</script>

<style scoped>
/* Inherits from dashboard.css */
</style>
