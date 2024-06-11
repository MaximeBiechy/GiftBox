document.addEventListener('DOMContentLoaded', () => {
    // ! Barre de navigation
    const navbarLinks = document.querySelectorAll('.navbar a');

    navbarLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });

    // ! Formulaire
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
});

