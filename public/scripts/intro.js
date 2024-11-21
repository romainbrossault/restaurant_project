window.addEventListener('load', function() {
    const intro = document.getElementById('intro');
    setTimeout(() => {
        intro.style.opacity = '0';
        setTimeout(() => {
            intro.style.display = 'none';
        }, 1000);
    }, 3000); 
});