// Show Button To Top
let button = document.getElementsByClassName('to-top-button')[0];

function showToTopButton() {
    removeEventListener('load', this)

    let scrolledHeight = document.documentElement.scrollTop;

    if (scrolledHeight > 200) {
        button.classList.add('show');
    } else {
        button.classList.remove('show');
    }
}

window.addEventListener('load', showToTopButton);
window.addEventListener('scroll', showToTopButton);

