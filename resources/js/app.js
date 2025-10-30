import './bootstrap';

const spotlightContainer = document.getElementById('spotlight-container');

function updateCursorPositionv2(e) {
    spotlightContainer.style.setProperty('--mouse-x', e.x + 'px');
    spotlightContainer.style.setProperty('--mouse-y', e.y + 'px');
}

// Add event listeners
document.addEventListener('mousemove', updateCursorPositionv2);


// Initialize position
spotlightContainer.style.setProperty('--mouse-x', '10%');
spotlightContainer.style.setProperty('--mouse-y', '10%');



// Modal JS

let dialog = document.querySelector('dialog');
let card = document.querySelectorAll('div.hobbieCard');

for (let i = 0, len = card.length; i < len; i++) {
    card[i].addEventListener('click', function () {
        dialog.showModal();
        dialog.querySelector('img').src = this.querySelector('img').src;
    });
}

window.addEventListener('click', function (event) {
    if (event.target == dialog) {
        dialog.close();
    }
});

