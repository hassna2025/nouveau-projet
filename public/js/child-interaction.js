// public/js/child-interaction.js
document.addEventListener('DOMContentLoaded', function() {
    // Effets sonores pour les interactions
    const playSound = (sound) => {
        const audio = new Audio(`/assets/audio/${sound}.mp3`);
        audio.volume = 0.3;
        audio.play().catch(e => console.log("Audio play prevented:", e));
    };
    
    // Sons au survol des boutons et cartes
    const interactiveElements = document.querySelectorAll('a, button, .category-card, .content-card');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => playSound('hover'));
        el.addEventListener('click', () => playSound('click'));
    });
    
    // Confetti pour les quiz réussis
    if (document.querySelector('.quiz-result.passed')) {
        playSound('success');
        // Ici vous pourriez ajouter une librairie confetti
    }
    
    // Animation des cartes
    const cards = document.querySelectorAll('.category-card, .content-card');
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Sons interactifs
    const playSound = (sound) => {
        const audio = new Audio(`/assets/audio/${sound}.mp3`);
        audio.volume = 0.3;
        audio.play().catch(e => console.log("Audio play prevented:", e));
    };

    // Sons au survol
    const interactiveElements = document.querySelectorAll(
        'a, button, .category-card, .content-card, input, select'
    );
    
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => playSound('pop'));
        el.addEventListener('click', () => playSound('click'));
    });

    // Confetti pour les succès
    if (document.querySelector('.quiz-result.passed')) {
        playSound('success');
        createConfetti();
    }

    // Animation des cartes
    const cards = document.querySelectorAll('.category-card, .content-card');
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });

    // Fonction confetti
    function createConfetti() {
        const colors = ['#ff6b6b', '#ffa3a3', '#ff8e8e', '#ff5252'];
        const container = document.querySelector('.quiz-result');
        
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.style.position = 'absolute';
            confetti.style.width = '10px';
            confetti.style.height = '10px';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.borderRadius = '50%';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.top = '-10px';
            confetti.style.opacity = Math.random();
            confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
            
            document.body.appendChild(confetti);
            
            // Supprimer après l'animation
            setTimeout(() => {
                confetti.remove();
            }, 5000);
        }
        
        // Ajouter l'animation CSS dynamiquement
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes fall {
                to { transform: translateY(100vh) rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    }

    // Cursor personnalisé
    const cursor = document.createElement('div');
    cursor.classList.add('custom-cursor');
    document.body.appendChild(cursor);
    
    document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
    });
});