<template>
    <header>
        <nav>
            <div class="weblogo-container">
                <div class="weblogo-frame">
                    <router-link :to="homeUrl">
                        <img :src="logoUrl" alt="Logo" class="logo" />
                    </router-link>
                </div>
            </div>
            
            <div v-if="roleInfo" class="admin-info">
                <span>{{ roleInfo }}</span>
            </div>

            <ul>
                <li v-for="link in navLinks" :key="link.url">
                    <router-link :to="link.url" :class="link.class || ''" active-class="active">{{ link.label }}</router-link>
                </li>
                
                <li v-if="isLoggedIn">
                    <button @click="handleLogout" class="logout-btn" :disabled="loggingOut">
                        {{ loggingOut ? 'Logging out...' : 'Logout' }}
                    </button>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
    logoUrl: { type: String, default: '/img/weblogo.png' },
    homeUrl: { type: String, default: '/' },
    isLoggedIn: { type: Boolean, default: false },
    navLinks: {
        type: Array,
        default: () => []
    },
    roleInfo: { type: String, default: '' }
});

const loggingOut = ref(false);

async function handleLogout() {
    loggingOut.value = true;
    try {
        await axios.post('/logout');
        window.User = undefined;
        window.location.href = '/login'; // Refresh to clear session and state
    } catch (error) {
            console.error('Logout failed:', error);
            alert('Logout failed. Please try again.');
        } finally {
            loggingOut.value = false;
        }
    }
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

header nav ul li a:hover,
header nav ul li a.active {
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

.admin-info {
  color: white;
  font-size: 18px;
  font-weight: 600;
  margin-left: 20px;
  flex: 1;
}
</style>
