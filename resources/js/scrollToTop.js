// Show Button To Top

let button = document.getElementsByClassName('to-top-button')[0];

function showToTopButton() {
    let scrolledHeight = document.body.scrollTop;

    if (scrolledHeight > 200) {
        button.classList.add('show');
    } else {
        button.classList.remove('show');
    }
}

document.body.addEventListener('scroll', showToTopButton);

