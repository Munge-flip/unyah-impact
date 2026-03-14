<template>
    <div class="service-category">
        <h3>{{ title }}</h3>
        <p v-if="description" class="category-description">{{ description }}</p>
        <div :class="[customLayout ? '' : 'service-options']">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    description: String,
    customLayout: Boolean
});
</script>

<style scoped>
/* Core styles are inherited from services.css */
.category-description {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
    font-style: italic;
}
</style>
