var swiper = new Swiper(".swiper", {
    cssMode: true,
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    keyboard: true,
    autoplay: {
        delay: 5000, 
        disableOnInteraction: false, // Defina como "false" para continuar a reprodução automática após a interação do usuário
    },
});


function toggleHeartColor(heartIcon) {
    heartIcon.classList.toggle('filled-heart');
}

// Adiciona um evento de clique a todos os ícones de coração
var heartIcons = document.querySelectorAll('[data-heart-id]');
heartIcons.forEach(function (heartIcon) {
    heartIcon.addEventListener('click', function () {
        toggleHeartColor(heartIcon);
    });
});






