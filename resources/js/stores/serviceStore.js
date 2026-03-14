import { reactive, computed } from 'vue';

export const serviceStore = reactive({
    game: 'Genshin Impact',
    selectedServices: {}, // category: { name, price, id }
    explorations: [],      // Array of region names
    paymentMethod: '',
    
    // Multiplier Logic
    multiplierCategories: ['Maintenance', 'Regular Quests', 'Events', 'Endgame', 'Unlocking Waypoints & Statues', 'Chest Farming', 'Collecting oculi', '100% Area Completion'],

    // Actions
    toggleService(category, serviceId, price, label) {
        if (this.selectedServices[category] && this.selectedServices[category].id === serviceId) {
            delete this.selectedServices[category];
        } else {
            this.selectedServices[category] = { name: label, price: price, id: serviceId };
        }
    },

    toggleRegion(regionName) {
        const index = this.explorations.indexOf(regionName);
        if (index > -1) {
            this.explorations.splice(index, 1);
        } else {
            this.explorations.push(regionName);
        }
    },

    // Computed Properties
    totalPriceRaw: computed(() => {
        let total = 0;
        const regionCount = serviceStore.explorations.length || 1;
        
        Object.keys(serviceStore.selectedServices).forEach(cat => {
            const item = serviceStore.selectedServices[cat];
            let multiplier = 1;
            
            // Check if this category should be multiplied by region count
            if (serviceStore.multiplierCategories.includes(cat) && serviceStore.explorations.length > 0) {
                multiplier = regionCount;
            }
            total += (item.price * multiplier);
        });
        return total;
    }),

    categoryString: computed(() => {
        return Object.keys(serviceStore.selectedServices).join(', ');
    }),

    serviceTypeString: computed(() => {
        const names = Object.values(serviceStore.selectedServices).map(s => s.name);
        let str = names.join(', ');
        if (serviceStore.explorations.length > 0) {
            str += ` (${serviceStore.explorations.join(', ')})`;
        }
        return str;
    })
});
