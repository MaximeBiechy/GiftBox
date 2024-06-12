document.addEventListener('DOMContentLoaded', () => {
    // ! Barre de navigation
    const navbarLinks = document.querySelectorAll('.navbar a');

    navbarLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });

    // ! Formulaire de création de box
    const cadeauCheckbox = document.getElementById('cadeau');
    const messageCadeauGroup = document.getElementById('message_cadeau_group');

    if (cadeauCheckbox != null) {
        cadeauCheckbox.addEventListener('change', function() {
            if (cadeauCheckbox.checked) {
                messageCadeauGroup.classList.remove('hide');
            } else {
                messageCadeauGroup.classList.add('hide');
                
            }
        });
    }

    // ! Détails de la box
    const quantityInputs = document.querySelectorAll('.quantity');
        
        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                const prestationCard = this.closest('.prestation-card');
                const unitPrice = prestationCard.querySelector('.price').getAttribute('data-price');
                const totalPriceElement = prestationCard.querySelector('.total-price');
                
                const newQuantity = parseInt(this.value);
                const newTotalPrice = (unitPrice * newQuantity);
                
                totalPriceElement.textContent = newTotalPrice;
            });
        });


   
});

