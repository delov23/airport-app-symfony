let lastScrollTop = 0;

document.querySelector('body').addEventListener('scroll', scrollFunc);

function scrollFunc() {
    const SIZE_DIVISION = 15;
    let elAbout = document.getElementById('about-text');
    let elLearn = document.getElementById('learn-text');
    elAbout.style.fontSize = Math.floor(window.pageYOffset / SIZE_DIVISION) + 'px';
    elLearn.style.fontSize = Math.floor(window.pageYOffset / SIZE_DIVISION) + 'px';
}

// * USED TO DISPLAY AN ANIMATION LEADING TO ABOUT
function displayAbout() {
    window.scrollTo(0, window.innerHeight);
    setTimeout(() => {
        window.scrollTo(0, window.innerHeight * 2);
        setTimeout(() => {
            window.scrollTo(0, window.innerHeight * 3);
        }, 1000);
    }, 1000);
}