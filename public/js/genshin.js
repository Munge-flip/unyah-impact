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
        explorations: [] 
    };

    // DOM Elements
    const serviceButtons = document.querySelectorAll('.service-btn');
    const explorationCards = document.querySelectorAll('.exploration-card');
    const totalPriceElement = document.getElementById('totalPrice');
    const selectedServicesElement = document.getElementById('selectedServices');
    
    // Hidden Inputs (These send data to Laravel)
    const inputGame = document.querySelector('input[name="game"]');
    const inputCategory = document.querySelector('input[name="service_category"]');
    const inputService = document.querySelector('input[name="service_type"]');
    const inputPrice = document.querySelector('input[name="price"]');
    const inputPayment = document.querySelector('input[name="payment_method"]');

    // 1. Handle Service Buttons
    serviceButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            const service = this.dataset.service;
            const price = parseInt(this.dataset.price);
            const label = this.querySelector('span').textContent;

            // Deselect other buttons in same category
            document.querySelectorAll(`[data-category="${category}"]`).forEach(btn => {
                btn.classList.remove('selected');
            });

            // Select this button
            this.classList.add('selected');
            
            // Update Data Object
            selectedServices[category] = { name: label, price: price, id: service };

            // Update Hidden Inputs for Laravel
            // Note: This logic assumes only 1 service can be bought per order for now.
            // If you want multiple, you need a different backend approach.
            if (inputCategory) inputCategory.value = category;
            if (inputService) inputService.value = label; 
            
            updateOrderSummary();
        });
    });

    // 2. Handle Exploration Cards
    explorationCards.forEach(card => {
        card.addEventListener('click', function() {
            const regionName = this.querySelector('h4').textContent;

            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
                selectedServices.explorations = selectedServices.explorations.filter(item => item !== regionName);
            } else {
                this.classList.add('selected');
                selectedServices.explorations.push(regionName);
            }
            updateOrderSummary();
        });
    });

    // 3. Update UI & Hidden Price Input
    function updateOrderSummary() {
        let total = 0;
        let summaryHTML = '';

        // Add services
        Object.keys(selectedServices).forEach(category => {
            if (category !== 'explorations' && selectedServices[category]) {
                const service = selectedServices[category];
                total += service.price;
                summaryHTML += `
                    <div class="selected-item">
                        <span>${service.name}</span>
                        <span>₱${service.price}</span>
                    </div>
                `;
            }
        });

        // Add explorations
        if (selectedServices.explorations.length > 0) {
            summaryHTML += `
                <div class="selected-item" style="background: #f0f0f0; padding: 10px; border-radius: 8px; margin-top: 10px;">
                    <span style="font-weight: 600;">Regions:</span>
                    <span>${selectedServices.explorations.join(', ')}</span>
                </div>
            `;
        }

        // Update HTML
        selectedServicesElement.innerHTML = summaryHTML || '<p style="color: #888; font-style: italic;">No services selected</p>';
        totalPriceElement.textContent = total.toLocaleString();

        // Update Hidden Price Input for Laravel
        if (inputPrice) inputPrice.value = total;
    }

    // 4. Handle Payment Method Selection
    const paymentRadios = document.querySelectorAll('input[name="payment-method"]');
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Update hidden input
            if (inputPayment) inputPayment.value = this.value;

            document.querySelectorAll('.payment-input').forEach(input => {
                input.disabled = true;
                input.style.opacity = '0.5';
            });
            const selectedInput = this.parentElement.querySelector('.payment-input');
            if (selectedInput) {
                selectedInput.disabled = false;
                selectedInput.style.opacity = '1';
                selectedInput.focus();
            }
        });
    });
});