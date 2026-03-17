<template>
  <form class="form-content active" :action="action" method="POST">
    <!-- Traditional CSRF Token for Laravel standard POST -->
    <slot name="csrf"></slot>

    <div v-if="errorEmail" class="alert-error">
      {{ errorEmail }}
    </div>

    <div class="form-group">
      <input 
        type="email" 
        name="email" 
        placeholder="Email" 
        required 
        v-model="email"
        :class="{ 'has-error': errorEmail }"
      >
    </div>
    
    <div class="form-group">
      <input 
        type="password" 
        name="password" 
        placeholder="Password" 
        required 
        v-model="password"
      >
    </div>

    <button type="submit" class="submit-btn">Sign In</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  action: {
    type: String,
    required: true
  },
  errorEmail: {
    type: String,
    default: ''
  },
  initialEmail: {
    type: String,
    default: ''
  }
});

const email = ref(props.initialEmail);
const password = ref('');
</script>

<style scoped>
/* Inheriting styles from auth.css */
</style>
