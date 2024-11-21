window.addEventListener('scroll', function() {
    const parallax = document.querySelector('.parallax-image');
    let scrollPosition = window.pageYOffset;
    parallax.style.transform = 'translate(-50%, calc(-50% + ' + scrollPosition * 0.5 + 'px))';

    const blurValue = Math.min(scrollPosition / 100, 10); // Limite le flou à 10px
    parallax.style.filter = `blur(${blurValue}px)`;
});

