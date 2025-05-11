// Funzione per gestire l'invio del modulo di contatto
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('form[action="processa_commenti.php"]');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(contactForm);
            fetch('processa_commenti.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.querySelector('.contact-section').innerHTML = `<p>${data}</p>`;
            })
            .catch(error => console.error('Errore:', error));
        });
    }
});

// Funzione per gestire la visualizzazione delle immagini nella galleria
document.addEventListener('DOMContentLoaded', function() {
    const galleryImages = document.querySelectorAll('.gallery-image.card img');
    galleryImages.forEach(image => {
        image.addEventListener('click', function() {
            const src = this.getAttribute('src');
            const alt = this.getAttribute('alt');
            const modal = document.createElement('div');
            modal.classList.add('modal');
            modal.innerHTML = `
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <img src="${src}" alt="${alt}">
                </div>
            `;
            document.body.appendChild(modal);

            const closeModal = modal.querySelector('.close');
            closeModal.addEventListener('click', function() {
                modal.remove();
            });

            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.remove();
                }
            });
        });
    });
});

// Funzione per cambiare il tema del sito
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.querySelector('#theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
        });
    }
});

// Funzione per aggiungere un effetto di scorrimento lento ai link di ancoraggio
document.addEventListener('DOMContentLoaded', function() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
});