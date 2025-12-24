
// Animação para cards aparecendo em sequência

import { animate } from "motion";

function animateCards() {
    const cards = document.querySelectorAll('.cartas');
    cards.forEach((card, index) => {
        card.classList.remove('hidden');
        animate(card, {
            opacity: [0, 1],
            y: [50, 0],
            scale: [0.9, 1]
        }, {
            duration: 0.9,
            delay: index * 0.1,
            easing: "ease-out"
        })

    })
}
function smoothWaveEffect() {
    const titulo = document.getElementById('titulo');
    const texto = titulo.textContent;

    titulo.innerHTML = texto.split('').map((letra) =>
        `<span class="wave-letter">${letra}</span>`
    ).join('');
    console.log(titulo.innerHTML);
    const letras = titulo.querySelectorAll('.wave-letter');

    letras.forEach((letra, index) => {
        animate(letra, {
            opacity: [0, 1]
        }, {
            duration: 0.3,
            delay: index * 0.04,
            easing: "ease-out"
        });
    });

}

window.document.addEventListener('DOMContentLoaded', () => {
    smoothWaveEffect();
    setTimeout(() => {
        animateCards();
    }, 300);
});