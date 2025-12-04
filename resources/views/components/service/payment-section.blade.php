<div class="payment-section">
    <input type="hidden" name="final_payment_status" id="finalPaymentStatus" value="unpaid">
    <h2>Choose Payment Method</h2>

    <div class="payment-type">
        <h3>QR / E-Wallet</h3>
        <div class="payment-options">

            <div class="payment-option">
                <input type="radio" id="gcash" name="payment-method" value="gcash">
                <label for="gcash" class="payment-card">
                    <strong>GCash</strong>
                    <span style="font-size: 12px; color: #666;">Scan to Pay</span>
                </label>
            </div>

            <div class="payment-option">
                <input type="radio" id="paypal" name="payment-method" value="paypal">
                <label for="paypal" class="payment-card">
                    <strong>PayPal</strong>
                    <span style="font-size: 12px; color: #666;">Redirect to Pay</span>
                </label>
            </div>

        </div>
    </div>
</div>

<div id="qrModal" class="modal" style="display: none;">
    <div class="modal-content" style="text-align: center;">
        <div class="modal-header">
            <h2>Scan to Pay</h2>
            <span class="close-modal" style="cursor: pointer;">&times;</span>
        </div>
        <div class="modal-body" style="padding: 30px;">
            <p style="margin-bottom: 20px;">Please scan this QR code with your GCash app to pay <strong id="qrAmount">₱0.00</strong></p>
            
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PayToUnyahImpact" alt="Payment QR" style="border: 5px solid #f0f0f0; border-radius: 10px; margin-bottom: 20px;">

            <div style="display: flex; gap: 10px; justify-content: center; margin-top: 10px;">
                <button type="button" class="btn-secondary" id="btnPayLater" style="flex: 1;">Pay Later</button>
                
                <button type="button" class="btn-primary" id="btnPaid" style="flex: 1;">I have completed payment</button>
            </div>
        </div>
    </div>
</div>