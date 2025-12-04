document.addEventListener('DOMContentLoaded', function() {
    
    const payModal = document.getElementById('payModal');
    const btnPayNow = document.getElementById('btnPayNow');
    const btnConfirmPayment = document.getElementById('btnConfirmPayment'); 
    const closeModalBtn = document.querySelector('.close-modal');
    const payNowForm = document.getElementById('payNowForm');

    if (btnPayNow) {
        btnPayNow.addEventListener('click', function(e) {
            e.preventDefault();
            if (payModal) {
                payModal.style.display = 'block';
            }
        });
    }

    if (btnConfirmPayment) {
        btnConfirmPayment.addEventListener('click', function() {
            if (payNowForm) {
                payNowForm.submit();
            }
        });
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            payModal.style.display = 'none';
        });
    }

    window.onclick = function(event) {
        if (event.target == payModal) {
            payModal.style.display = "none";
        }
    }
});