window.addEventListener('load', function() {
    const intro = document.getElementById('intro');
    const introImage = document.getElementById('intro-image');
    const introLeft = document.createElement('div');
    const introRight = document.createElement('div');

    introLeft.id = 'intro-left';
    introRight.id = 'intro-right';

    intro.appendChild(introLeft);
    intro.appendChild(introRight);

    setTimeout(() => {
        introImage.style.animation = 'slideOutLeft 1s ease-in-out forwards';
        introLeft.style.animation = 'openBackgroundLeft 1s ease-in-out forwards';
        introRight.style.animation = 'openBackgroundRight 1s ease-in-out forwards';
        setTimeout(() => {
            intro.style.display = 'none';
        }, 1000);
    }, 3000); 
});