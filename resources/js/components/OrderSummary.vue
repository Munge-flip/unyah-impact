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
                
                <!-- Extras Lists -->
                <div v-if="serviceStore.explorations.length > 0" class="selected-item mt-4 p-2 bg-gray-100 rounded">
                    <strong>Regions:</strong>
                    <span>{{ serviceStore.explorations.join(', ') }}</span>
                </div>
                <div v-if="serviceStore.worlds.length > 0" class="selected-item mt-4 p-2 bg-gray-100 rounded">
                    <strong>Worlds:</strong>
                    <span>{{ serviceStore.worlds.join(', ') }}</span>
                </div>
                <div v-if="serviceStore.hollowModes.length > 0" class="selected-item mt-4 p-2 bg-gray-100 rounded">
                    <strong>Modes:</strong>
                    <span>{{ serviceStore.hollowModes.join(', ') }}</span>
                </div>
            </div>
            
            <div class="total-price">
                Total: ₱{{ serviceStore.totalPriceRaw.toLocaleString() }}
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

function formatItemPrice(category, item) {
    let multiplier = 1;
    const regionCount = serviceStore.explorations.length;
    const worldCount = serviceStore.worlds.length;
    const modeCount = serviceStore.hollowModes.length;

    if (serviceStore.multiplierCategories.includes(category)) {
        if (category === 'simulated-clear' && worldCount > 0) {
            multiplier = worldCount;
        } else if (category === 'hollow-zero' && modeCount > 0) {
            multiplier = modeCount;
        } else if (regionCount > 0) {
            multiplier = regionCount;
        }
    }
    
    if (multiplier > 1) {
        return `₱${item.price} × ${multiplier} = ₱${(item.price * multiplier).toLocaleString()}`;
    }
    return `₱${item.price.toLocaleString()}`;
}

function submitForm() {
    const form = document.getElementById('serviceForm');
    if (form) form.submit();
}
</script>

<style scoped>
.placeholder-text {
    color: #888;
    font-style: italic;
    font-size: 14px;
}
.order-summary-wrapper {
    margin-top: 30px;
}
.mt-4 { margin-top: 1rem; }
.p-2 { padding: 0.5rem; }
.bg-gray-100 { background-color: #f3f4f6; }
.rounded { border-radius: 0.25rem; }
</style>
