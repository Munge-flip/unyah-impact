<template>
  <form class="form-content active" :action="action" method="POST">
    <!-- Traditional CSRF Token for Laravel standard POST -->
    <slot name="csrf"></slot>

    <div class="form-group">
      <input 
        type="text" 
        name="name" 
        placeholder="Name" 
        required 
        v-model="name"
        :class="{ 'has-error': errors.name }"
      >
      <span v-if="errors.name" class="text-error">{{ errors.name[0] }}</span>
    </div>

    <div class="form-group">
      <input 
        type="email" 
        name="email" 
        placeholder="Email" 
        required 
        v-model="email"
        :class="{ 'has-error': errors.email }"
      >
      <span v-if="errors.email" class="text-error">{{ errors.email[0] }}</span>
    </div>

    <div class="form-group">
      <input 
        type="tel" 
        name="phone" 
        placeholder="Phone Number" 
        required 
        v-model="phone"
        :class="{ 'has-error': errors.phone }"
      >
      <span v-if="errors.phone" class="text-error">{{ errors.phone[0] }}</span>
    </div>

    <div class="form-group">
      <input 
        type="password" 
        name="password" 
        placeholder="Password" 
        required 
        v-model="password"
        :class="{ 'has-error': errors.password }"
      >
      <span v-if="errors.password" class="text-error">{{ errors.password[0] }}</span>
    </div>

    <div class="form-group">
      <input 
        type="password" 
        name="password_confirmation" 
        placeholder="Confirm Password" 
        required 
        v-model="passwordConfirmation"
      >
    </div>

    <button type="submit" class="submit-btn">Sign Up</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  action: {
    type: String,
    required: true
  },
  errors: {
    type: Object,
    default: () => ({})
  },
  old: {
    type: Object,
    default: () => ({})
  }
});

const name = ref(props.old.name || '');
const email = ref(props.old.email || '');
const phone = ref(props.old.phone || '');
const password = ref('');
const passwordConfirmation = ref('');
</script>

<style scoped>
/* Inheriting styles from auth.css */
.text-error {
  color: #e74c3c;
  font-size: 12px;
  margin-top: 5px;
  margin-left: 20px;
  display: block;
}
</style>
