<template>
    <header>
        <nav>
            <div class="weblogo-container">
                <div class="weblogo-frame">
                    <a :href="homeUrl">
                        <img :src="logoUrl" alt="Logo" class="logo" />
                    </a>
                </div>
            </div>
            
            <ul>
                <li v-for="link in navLinks" :key="link.url">
                    <a :href="link.url" :class="link.class || ''">{{ link.label }}</a>
                </li>
                
                <li v-if="isLoggedIn && logoutUrl">
                    <form method="POST" :action="logoutUrl" style="display: inline;">
                        <slot name="csrf"></slot>
                        <button type="submit" class="logout-btn">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    logoUrl: { type: String, default: '/img/weblogo.png' },
    homeUrl: { type: String, default: '/' },
    isLoggedIn: { type: Boolean, default: false },
    logoutUrl: { type: String, default: '' },
    navLinks: {
        type: Array,
        default: () => []
    }
});
</script>

<style scoped>
header nav ul {
  display: flex;
  align-items: center;
  list-style: none;
  gap: 20px;
}

header nav ul li a {
  text-decoration: none;
  font-size: 22px;
  color: #ffffff;
  transition: all 0.3s ease;
  padding: 8px 16px;
  border-radius: 4px;
}

header nav ul li a:hover {
  color: #a78bfa;
  background-color: rgba(167, 139, 250, 0.1);
}

.logout-btn {
  background: none;
  border: none;
  color: #ef4444;
  font-family: 'Syne', sans-serif;
  font-size: 22px;
  cursor: pointer;
  padding: 8px 16px;
  transition: all 0.3s ease;
}

.logout-btn:hover {
  background-color: rgba(239, 68, 68, 0.1);
  border-radius: 4px;
}

.btn-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white !important;
  font-size: 16px !important;
  padding: 8px 20px !important;
}
</style>
