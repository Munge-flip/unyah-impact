<template>
    <div class="payment-section">
        <h2>Choose Payment Method</h2>

        <div class="payment-type">
            <h3>QR</h3>
            <div class="payment-options">
                <div class="payment-option">
                    <label>
                        <input type="radio" id="gcash" name="payment" value="gcash" v-model="serviceStore.paymentMethod">
                        <strong>GCash</strong>
                    </label>
                    <input type="text" readonly class="payment-input" value="Gcash">
                </div>
                <div class="payment-option">
                    <label>
                        <input type="radio" id="paypal" name="payment" value="paypal" v-model="serviceStore.paymentMethod">
                        <strong>PayPal</strong>
                    </label>
                    <input type="text" readonly class="payment-input" value="Paypal">
                </div>
            </div>
        </div>

        <div class="payment-type">
            <h3>E-wallet</h3>
            <div class="payment-options">
                <div class="payment-option">
                    <label>
                        <input type="radio" id="gcash-wallet" name="payment" value="gcash" v-model="serviceStore.paymentMethod">
                        <strong>GCash</strong>
                    </label>
                    <input type="text" readonly class="payment-input" value="Gcash">
                </div>
                <div class="payment-option">
                    <label>
                        <input type="radio" id="paypal-wallet" name="payment" value="paypal" v-model="serviceStore.paymentMethod">
                        <strong>PayPal</strong>
                    </label>
                    <input type="text" readonly class="payment-input" value="Paypal">
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { serviceStore } from '../stores/serviceStore';
</script>

<style scoped>
/* Inheriting core styles from services.css */
</style>
