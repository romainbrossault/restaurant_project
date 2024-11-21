document.addEventListener('DOMContentLoaded', function() {
    const waveElement = document.querySelector('.wave');
    waveElement.style.animationPlayState = 'running';
});

document.addEventListener('DOMContentLoaded', function() {
    const gridItems = document.querySelectorAll('.grid-item');
    const scrollImage = document.querySelector('.scroll-image');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    gridItems.forEach(item => {
        observer.observe(item);
    });

    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;
        const opacity = 1 - (scrollPosition / windowHeight);
        scrollImage.style.opacity = Math.max(opacity, 0);
    });
});