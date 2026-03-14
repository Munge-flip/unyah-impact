<template>
    <div class="order-summary-wrapper">
        <div class="order-summary">
            <h3>Order Summary</h3>
            <div id="selectedServices">
                <p v-if="Object.keys(serviceStore.selectedServices).length === 0" class="placeholder-text">
                    No services selected
                </p>
                <div v-else>
                    <div v-for="(item, cat) in serviceStore.selectedServices" :key="cat" class="selected-item">
                        <span>{{ item.name }}</span>
                        <span>{{ formatItemPrice(cat, item) }}</span>
                    </div>
                </div>
                
                <!-- Regions List -->
                <div v-if="serviceStore.explorations.length > 0" class="selected-item mt-4 p-2 bg-gray-100 rounded">
                    <strong>Regions:</strong>
                    <span>{{ serviceStore.explorations.join(', ') }}</span>
                </div>
            </div>
            
            <div class="total-price">
                Total: ₱{{ totalPrice }}
            </div>
        </div>

        <div class="order-confirmation">
            <h2>Order Confirmation</h2>
            <p>By availing the service I automatically agree <a href="#">Terms of Service</a></p>
            
            <button 
                type="button" 
                @click="submitForm"
                class="submit-btn"
                :disabled="!canPlaceOrder"
            >
                Get Service
            </button>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { serviceStore } from '../stores/serviceStore';

const canPlaceOrder = computed(() => {
    return Object.keys(serviceStore.selectedServices).length > 0 && serviceStore.paymentMethod;
});

const totalPrice = computed(() => {
    let total = 0;
    const regionCount = serviceStore.explorations.length || 1;
    
    Object.keys(serviceStore.selectedServices).forEach(cat => {
        const item = serviceStore.selectedServices[cat];
        let multiplier = 1;
        if (serviceStore.multiplierCategories.includes(cat) && serviceStore.explorations.length > 0) {
            multiplier = regionCount;
        }
        total += (item.price * multiplier);
    });
    return total.toLocaleString();
});

function formatItemPrice(category, item) {
    let multiplier = 1;
    if (serviceStore.multiplierCategories.includes(category) && serviceStore.explorations.length > 0) {
        multiplier = serviceStore.explorations.length;
    }
    
    if (multiplier > 1) {
        return `₱${item.price} × ${multiplier} = ₱${item.price * multiplier}`;
    }
    return `₱${item.price}`;
}

function submitForm() {
    const form = document.getElementById('serviceForm');
    if (form) form.submit();
}
</script>
