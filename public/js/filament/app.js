// Fungsi untuk animasi angka
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Inisialisasi AOS (Animate On Scroll)
document.addEventListener("DOMContentLoaded", function () {
    // Tampilkan elemen dengan fadeIn animation
    const fadeElements = document.querySelectorAll(".fade-in");
    fadeElements.forEach((element) => {
        element.style.opacity = "0";
        element.style.animation = "fadeIn 1s forwards";
    });

    // Tampilkan elemen dengan slideUp animation
    const slideElements = document.querySelectorAll(".slide-up");
    slideElements.forEach((element, index) => {
        element.style.opacity = "0";
        element.style.animation = `slideUp 0.6s forwards ${index * 0.1}s`;
    });

    // Tambahkan efek hover ke agenda cards
    const agendaCards = document.querySelectorAll(".agenda-card");
    agendaCards.forEach((card) => {
        card.addEventListener("mouseenter", function () {
            this.classList.add("hover-effect");
        });

        card.addEventListener("mouseleave", function () {
            this.classList.remove("hover-effect");
        });
    });
});

// Fungsi untuk membuat konfeti ketika tidak ada agenda
function showConfetti() {
    if (document.querySelector(".no-agenda")) {
        // Simulasi konfeti sederhana jika tidak ada agenda
        const confettiContainer = document.querySelector(".no-agenda");
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement("div");
            confetti.className = "confetti-piece";
            confetti.style.left = `${Math.random() * 100}%`;
            confetti.style.animationDelay = `${Math.random() * 3}s`;
            confetti.style.backgroundColor = `hsl(${
                Math.random() * 360
            }, 80%, 60%)`;
            confettiContainer.appendChild(confetti);
        }
    }
}

// Panggil fungsi showConfetti setelah DOM dimuat
document.addEventListener("DOMContentLoaded", showConfetti);
