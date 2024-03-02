import './bootstrap';
import 'flowbite';
import '../css/app.css';

    document.addEventListener("DOMContentLoaded", function() {
        const decrementButton = document.getElementById("decrement-button");
        const incrementButton = document.getElementById("increment-button");
        const quantityInput = document.getElementById("quantity-input");

        decrementButton.addEventListener("click", function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        incrementButton.addEventListener("click", function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < parseInt(quantityInput.getAttribute("data-input-counter-max"))) {
                quantityInput.value = currentValue + 1;
            }
        });
    });

    function updateAmount(amount) {
        document.getElementById('amount').value = amount;
    }