document.addEventListener('DOMContentLoaded', function() {
    
    // Store selected services
    const selectedServices = {
        maintenance: null,
        quests: null,
        events: null,
        endgame: null,
        waypoints: null,
        chest: null,
        oculi: null,
        completion: null,
        'hollow-zero': null,
        'simulated-clear': null,
        divergent: null,
        explorations: [],      // Genshin regions
        'hollow-modes': [],    // ZZZ modes
        worlds: []             // HSR worlds
    };

    // Categories that should be MULTIPLIED by region/world count
    const multiplierCategories = ['waypoints', 'chest', 'oculi', 'completion'];

    // DOM Elements
    const serviceButtons = document.querySelectorAll('.service-btn');
    const explorationCards = document.querySelectorAll('.exploration-card');
    const modeCards = document.querySelectorAll('.mode-card');
    const worldCards = document.querySelectorAll('.world-card');
    
    const totalPriceElement = document.getElementById('totalPrice');
    const selectedServicesElement = document.getElementById('selectedServices');
    
    // Hidden Inputs
    const inputCategory = document.querySelector('input[name="service_category"]');
    const inputService = document.querySelector('input[name="service_type"]');
    const inputPrice = document.querySelector('input[name="price"]');
    const inputPayment = document.querySelector('input[name="payment_method"]');

    // ==================================================
    // 1. SERVICE BUTTONS (Single selection per category)
    // ==================================================
    serviceButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            const service = this.dataset.service;
            const price = parseInt(this.dataset.price);
            const label = this.querySelector('span').textContent;

            // Get all buttons in the same category
            const categoryButtons = document.querySelectorAll(`[data-category="${category}"]`);
            
            // Check if this button is already selected
            if (this.classList.contains('selected')) {
                // Deselect
                this.classList.remove('selected');
                selectedServices[category] = null;
            } else {
                // Deselect all other buttons in this category
                categoryButtons.forEach(btn => btn.classList.remove('selected'));
                
                // Select this button
                this.classList.add('selected');
                selectedServices[category] = {
                    name: label,
                    price: price,
                    id: service
                };
            }

            updateOrderSummary();
        });
    });

    // ==================================================
    // 2. EXPLORATION CARDS (Genshin) - Multi-Select
    // ==================================================
    explorationCards.forEach(card => {
        card.addEventListener('click', function() {
            this.classList.toggle('selected');
            
            const h4 = this.querySelector('h4');
            if (!h4) return;
            
            const regionName = h4.textContent.trim();

            if (this.classList.contains('selected')) {
                if (!selectedServices.explorations.includes(regionName)) {
                    selectedServices.explorations.push(regionName);
                }
            } else {
                selectedServices.explorations = selectedServices.explorations.filter(item => item !== regionName);
            }
            
            updateOrderSummary();
        });
    });

    // ==================================================
    // 3. MODE CARDS (ZZZ) - Multi-Select
    // ==================================================
    modeCards.forEach(card => {
        card.addEventListener('click', function() {
            this.classList.toggle('selected');
            
            const modeLabel = this.querySelector('.mode-label');
            if (!modeLabel) return;
            
            const modeName = modeLabel.textContent.trim();

            if (this.classList.contains('selected')) {
                if (!selectedServices['hollow-modes'].includes(modeName)) {
                    selectedServices['hollow-modes'].push(modeName);
                }
            } else {
                selectedServices['hollow-modes'] = selectedServices['hollow-modes'].filter(item => item !== modeName);
            }
            
            updateOrderSummary();
        });
    });

    // ==================================================
    // 4. WORLD CARDS (HSR) - Multi-Select
    // ==================================================
    worldCards.forEach(card => {
        card.addEventListener('click', function() {
            this.classList.toggle('selected');
            
            const worldLabel = this.querySelector('.world-label');
            if (!worldLabel) return;
            
            const worldName = worldLabel.textContent.trim();

            if (this.classList.contains('selected')) {
                if (!selectedServices.worlds.includes(worldName)) {
                    selectedServices.worlds.push(worldName);
                }
            } else {
                selectedServices.worlds = selectedServices.worlds.filter(item => item !== worldName);
            }
            
            updateOrderSummary();
        });
    });

    // ==================================================
    // 5. UPDATE ORDER SUMMARY WITH MULTIPLIER LOGIC
    // ==================================================
    function updateOrderSummary() {
        let total = 0;
        let summaryHTML = '';

        // Determine the multiplier based on selected regions/worlds
        const regionCount = selectedServices.explorations.length || 1;  // Default to 1 if no regions
        const worldCount = selectedServices.worlds.length || 1;          // Default to 1 if no worlds
        const modeCount = selectedServices['hollow-modes'].length || 1;  // Default to 1 if no modes

        // Add all selected services (buttons only, not cards)
        Object.keys(selectedServices).forEach(category => {
            // Skip array properties (those are cards)
            if (category !== 'explorations' && category !== 'hollow-modes' && category !== 'worlds') {
                if (selectedServices[category]) {
                    const service = selectedServices[category];
                    let servicePrice = service.price;
                    let multiplier = 1;

                    // Check if this category should be multiplied
                    if (multiplierCategories.includes(category)) {
                        // Determine which multiplier to use based on game
                        if (selectedServices.explorations.length > 0) {
                            multiplier = regionCount;
                        } else if (selectedServices.worlds.length > 0) {
                            multiplier = worldCount;
                        } else if (selectedServices['hollow-modes'].length > 0) {
                            multiplier = modeCount;
                        }
                    }

                    const finalPrice = servicePrice * multiplier;
                    total += finalPrice;

                    // Show multiplier in UI if > 1
                    const priceDisplay = multiplier > 1 
                        ? `₱${servicePrice} × ${multiplier} = ₱${finalPrice}`
                        : `₱${finalPrice}`;

                    summaryHTML += `
                        <div class="selected-item">
                            <span>${service.name}</span>
                            <span>${priceDisplay}</span>
                        </div>
                    `;
                }
            }
        });

        // Display selected regions (Genshin)
        if (selectedServices.explorations.length > 0) {
            summaryHTML += `
                <div class="selected-item" style="background: #f0f0f0; padding: 10px; border-radius: 8px; margin-top: 10px;">
                    <span style="font-weight: 600;">Selected Regions (${selectedServices.explorations.length}):</span>
                    <span>${selectedServices.explorations.join(', ')}</span>
                </div>
            `;
        }

        // Display selected modes (ZZZ)
        if (selectedServices['hollow-modes'].length > 0) {
            summaryHTML += `
                <div class="selected-item" style="background: #f0f0f0; padding: 10px; border-radius: 8px; margin-top: 10px;">
                    <span style="font-weight: 600;">Hollow Zero Modes (${selectedServices['hollow-modes'].length}):</span>
                    <span>${selectedServices['hollow-modes'].join(', ')}</span>
                </div>
            `;
        }

        // Display selected worlds (HSR)
        if (selectedServices.worlds.length > 0) {
            summaryHTML += `
                <div class="selected-item" style="background: #f0f0f0; padding: 10px; border-radius: 8px; margin-top: 10px;">
                    <span style="font-weight: 600;">Selected Worlds (${selectedServices.worlds.length}):</span>
                    <span>${selectedServices.worlds.join(', ')}</span>
                </div>
            `;
        }

        // Update display
        if (summaryHTML === '') {
            selectedServicesElement.innerHTML = '<p style="color: #888; font-style: italic;">No services selected</p>';
        } else {
            selectedServicesElement.innerHTML = summaryHTML;
        }

        totalPriceElement.textContent = total.toLocaleString();

        // Update hidden inputs for Laravel
        updateHiddenInputs(total);
    }

    // ==================================================
    // 6. UPDATE HIDDEN INPUTS FOR LARAVEL
    // ==================================================
    function updateHiddenInputs(total) {
        // Get all selected service categories
        const categories = Object.keys(selectedServices)
            .filter(k => !['explorations', 'hollow-modes', 'worlds'].includes(k))
            .filter(k => selectedServices[k] !== null)
            .join(', ');
        
        if (inputCategory) inputCategory.value = categories;

        // Get all selected service names
        const serviceNames = Object.keys(selectedServices)
            .filter(k => !['explorations', 'hollow-modes', 'worlds'].includes(k))
            .filter(k => selectedServices[k] !== null)
            .map(k => selectedServices[k].name);

        // Combine all card selections
        const allCardSelections = [
            ...selectedServices.explorations,
            ...selectedServices['hollow-modes'],
            ...selectedServices.worlds
        ];

        // Build the full service string
        let fullService = serviceNames.join(', ');
        if (allCardSelections.length > 0) {
            fullService += " (" + allCardSelections.join(', ') + ")";
        }

        if (inputService) inputService.value = fullService;
        if (inputPrice) inputPrice.value = total;
    }

    // ==================================================
    // 7. PAYMENT METHOD
    // ==================================================
    const paymentRadios = document.querySelectorAll('input[name="payment-method"]');
    
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Update hidden input
            if (inputPayment) inputPayment.value = this.value;

            // Disable all payment inputs
            document.querySelectorAll('.payment-input').forEach(input => {
                input.disabled = true;
                input.style.opacity = '0.5';
            });

            // Enable the selected payment input
            const selectedInput = this.parentElement.querySelector('.payment-input');
            if (selectedInput) {
                selectedInput.disabled = false;
                selectedInput.style.opacity = '1';
                selectedInput.focus();
            }
        });
    });

    // Initialize - disable all payment inputs
    document.querySelectorAll('.payment-input').forEach(input => {
        input.disabled = true;
        input.style.opacity = '0.5';
    });

    // Initialize order summary
    updateOrderSummary();
});